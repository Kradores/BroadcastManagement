<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\NotificationsController;

class PagesController extends Controller
{
    public function index() {
        return view("dashboard");
    }

    public function status() {
        return view("pages.status");
    }
}
