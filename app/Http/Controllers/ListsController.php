<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListsController extends Controller
{
    public function index() {
        return view("pages.list");
    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'list' => 'required|mimes:csv,txt|max:1999',
        ]);

        // Get filename with extension
        $filenameWithExt = $request->file('list')->getClientOriginalName();

        // Get only filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get extension
        $extension = "csv";

        // Create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        // Upload image
        $path = $request->file('list')->storeAs('public/broadcast_list', $filenameToStore);

        return back()->with('success', "Broadcast List Updated");
    }
}
