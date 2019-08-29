<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class StatusController extends Controller
{
    public function index() {
        return view("pages.status");
    }

    public function start() {
        Artisan::call('exec:start');
        $result = Artisan::output();
        return back()->with('success', $result);
    }

    public function stop() {
        Artisan::call('exec:stop');
        $result = Artisan::output();
        return back()->with('success', $result);
    }

    public function getCurrentStatus() {
        Artisan::call('exec:status');
        $result = Artisan::output();
        $result = json_decode($result, true);
        $data = [
            'success' => 'Broadcast Script is Active',
            'start' => $result['start'],
            'duration' => $result['duration']
        ];
        return back()->with($data);
    }
}
