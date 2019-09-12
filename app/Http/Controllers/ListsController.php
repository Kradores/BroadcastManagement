<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UploadFileEvent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Events\UpdateBroadcastListEvent;
use App\Events\UploadEvent;
use JildertMiedema\LaravelPlupload\Facades\Plupload;

class ListsController extends Controller
{
    public function index() {
        return view("pages.list");
    }

    public function update(Request $request) {

        $this->validate($request, [
            'action' => 'required',
            'file' => 'required|file|mimes:csv,txt|max:499999', // 500MB
        ]);

        $folder = 'lists';
        $path = $this->uploadFile($request, $folder);

        event(new UpdateBroadcastListEvent($request->input('action'), $path, $folder));

        return back()->with('success', "Broadcast List Successfully Updated");
    }

    public function prepareList(Request $request) {

        $this->validate($request, [
            'msisdn' => 'required|digits:11',
        ]);

        $connection = DB::connection();

        $delete = "DELETE FROM ListaToBroadcast WHERE id IN 
                    (
                        SELECT id FROM 
                        (
                            SELECT t1.id id FROM ListaToBroadcast t1
                            INNER JOIN
                            (
                                SELECT MAX(id) id, msisdn FROM ListaToBroadcast GROUP BY msisdn
                            ) t0
                            ON 
                            t1.id <> t0.id AND t1.msisdn = t0.msisdn
                        ) t10
                    );";
        $connection->select(DB::raw($delete));

        $beforeCleaning = $connection->table("ListaToBroadcast")->count('id');

        $call = "CALL ForBroadcasting(".$request->input('msisdn').");";
        $connection->getPdo()->exec($call);

        $afterCleaning = $connection->table("ListaToBroadcast")->count('id');

        $data = [
            'rows' => ['before' => $beforeCleaning,
                'after' => $afterCleaning,
            ],
            'success' => 'Broadcast List Successfully Updated'
        ];

        return back()->with($data);
        
    }

    private function uploadFile(Request $request, $folder) {
        // Create new filename
        $filenameToStore = 'broadcast_list_'.time().'.csv';

        // Manually specify a file name...
        Storage::putFileAs($folder, $request->file('list'), $filenameToStore);
        $path = Storage::disk('local')->path($folder.'/'.$filenameToStore);
        $winPath = str_replace("\\", "/", $path);
        return $winPath;
    }

    private function getPath($folder) {
        // Create new filename
        $filenameToStore = 'broadcast_list.csv';

        // Manually specify a file name...
        $path = Storage::disk('local')->path($folder.'/'.$filenameToStore);
        $winPath = str_replace("\\", "/", $path);
        return $winPath;
    }

    public function upload(Request $request) {

        $chunk = $request->chunk;
        $chunks = $request->chunks;
        $file = $_FILES['file'];
        $folder = 'lists';
        $filePathPartial = storage_path() . "/plupload/broadcast_list.csv.part";
        $filePathComplete = storage_path() . "/app/{$folder}/broadcast_list.csv";

        // check if there is any unfinished upload
        if($chunk == 0 && $chunks > 1 && file_exists($filePathPartial)) {
            unlink($filePathPartial);
        }

        $this->appendData($filePathPartial, $file);

        if($chunk == $chunks - 1) {
            rename($filePathPartial, $filePathComplete);
            
            $path = $this->getPath($folder);
            event(new UpdateBroadcastListEvent($request->header('action'), $path, $folder));
        }

        $percentage = round(($chunk+1)/$chunks * 100, 2);

        event(new UploadEvent($percentage));
    }

    private function appendData($filePathPartial, $file)
    {
        if (!$out = @fopen($filePathPartial, 'ab')) {
            return back()->with('error', "Broadcast List Upload Failed, couldn't write to part file");
        }

        if (!$in = @fopen($file['tmp_name'], 'rb')) {
            return back()->with('error', "Broadcast List Upload Failed, couldn't read tmp file");
        }
        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);
    }
}
