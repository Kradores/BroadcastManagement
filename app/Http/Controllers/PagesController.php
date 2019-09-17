<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\NotificationsController;

class PagesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view("dashboard");
    }

    
}
