<?php

namespace App\Http\Controllers;

use App\BroadcastList;
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
            'list' => 'required|mimes:csv,txt|max:499999', // 500MB
        ]);
        
        $listsDir = 'lists';
        $path = $this->uploadFile($request, $listsDir);

        if($request->input('action') == 'new') {
            $this->truncate();
        }
        $this->insert($path);

        Storage::disk('public')->delete($listsDir.'/'.basename($path));

        //return back()->with('success', "Broadcast List Successfully Updated");
        return response()->json(['success' => "Broadcast List Successfully Updated"]);
    }

    private function uploadFile(Request $request, $listsDir) {

        // Get extension
        $extension = "csv";

        // Create new filename
        $filenameToStore = 'broadcast_list_'.time().'.'.$extension;

        // Upload image
        // $path = $request->file('list')->storeAs('public/broadcast_list', $filenameToStore);

        // Manually specify a file name...
        Storage::putFileAs('public/'.$listsDir, $request->file('list'), $filenameToStore);
        $link = 'storage/'.$listsDir.'/'.$filenameToStore;

        return $link;
    }

    private function insert($path) {
        $query = "LOAD DATA LOCAL INFILE '$path' INTO TABLE ListaToBroadcast FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES (@col1) SET msisdn=@col1;";
        DB::connection()->getPdo()->exec($query);
    }

    private function truncate() {
        DB::table('ListaToBroadcast')->truncate();
    }

    public function prepareList(Request $request) {

        $this->validate($request, [
            'msisdn' => 'required|digits:11',
        ]);

        $connection = DB::connection();

        $beforeCleaning = $connection->table("ListaToBroadcast")->count('id');

        $call = "CALL ForBroadcasting(".$request->input('msisdn').");";
        $connection->getPdo()->exec($call);

        $delete = "DELETE FROM ListaToBroadcast WHERE id IN 
                    (
                        SELECT id FROM 
                        (SELECT MAX(id) id, count(*) cnt FROM ListaToBroadcast GROUP BY msisdn HAVING cnt > 1) t0
                    );";
        $connection->select(DB::raw($delete));

        $afterCleaning = $connection->table("ListaToBroadcast")->count('id');

        $data = [
            'rows' => ['before' => $beforeCleaning,
                'after' => $afterCleaning,
            ],
            'success' => 'Broadcast List Successfully Updated'
        ];

        return back()->with($data);
        
    }
}
