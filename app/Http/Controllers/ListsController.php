<?php

namespace App\Http\Controllers;

use App\Events\UpdateBroadcastListEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ListsController extends Controller
{
    public function index() {
        return view("pages.list");
    }

    public function update(Request $request) {

        $this->validate($request, [
            'action' => 'required',
            'list' => 'required|file|mimes:csv,txt|max:499999', // 500MB
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
}
