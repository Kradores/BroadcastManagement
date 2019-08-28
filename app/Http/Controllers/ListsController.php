<?php

namespace App\Http\Controllers;

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
        
        return back()->with('success', "Broadcast List Successfuly Updated");
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
        $query = "TRUNCATE TABLE ListaToBroadcast;";
        DB::connection()->getPdo()->exec($query);
    }
}
