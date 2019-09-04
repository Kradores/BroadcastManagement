<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TusPhp\Tus\Client;
use TusPhp\Tus\Server;

class TusController extends Controller
{
    public function index() {
        return view('pages.upload');
    }

    public function server() {
        $server = new Server();
        $server->setUploadDir('C:/wamp64/www/BroadcastManagement/storage/app/public/lists');
        $response = $server->serve();
        dd($server);

        $response->send();

        exit(0);
    }

    public function client() {
        $client = new Client('http://broadcaster.test/tus');

        // Set upload key and file meta
        $uploadKey = "myuniquekey";
        $client->setKey($uploadKey)->file($_FILES['tus_file']['tmp_name'], 'broadcast_list');
        

    }
}
