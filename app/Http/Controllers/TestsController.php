<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OutgoingSms;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;

class TestsController extends Controller
{
    public function index() {
        return view("pages.test");
    }

    public function send(Request $request) {

        $this->validate($request, [
            'msisdn' => 'required|digits:11'
        ]);

        $msisdn = $request->input('msisdn');
        Artisan::command('exec:test {msisdn}', function ($msisdn) {
            $this->info("Sending Test SMS to msisdn {$msisdn}!");
        });
        
        $sms = OutgoingSms::where('dst_adress', $msisdn)->orderBy('id', 'desc')->take(1)->get();

        $data = [
            'success' => 'Test SMS Successfuly Sended. Refresh Result below if Status is not 8 or 16',
            'sms' => collect($sms)->first()
        ];

        return redirect('settings/test')->with($data);
    }

    public function show(Request $request) {

        $this->validate($request, [
            'msisdn' => 'required|digits:11'
        ]);

        $msisdn = $request->input('msisdn');

        $sms = OutgoingSms::where('dst_adress', $msisdn)->orderBy('id', 'desc')->take(1)->get();
            
        $data = [
            'success' => 'Request Successfuly Executed',
            'sms' => collect($sms)->first()
        ];

        return back()->with($data);
    }

    public function refresh($id) {
        $sms = OutgoingSms::where('id', $id)->orderBy('id', 'desc')->take(1)->get();
        $data = [
            'success' => "If you still didn't get status 8. Check SMPP",
            'sms' => collect($sms)->first()
        ];
        return back()->with($data);
    }

    public function checkSmpp() {
        Artisan::command('exec:curlsmpp {link}', function ($link) {
            $this->info("Checking SMPP Link {$link}!");
        });
    }
}
