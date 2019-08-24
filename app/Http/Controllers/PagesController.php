<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        return view("dashboard");
    }

    public function notif() {
        return view("pages.notif");
    }

    public function test() {
        return view("pages.test");
    }

    public function list() {
        return view("pages.list");
    }

    public function status() {
        return view("pages.status");
    }
}
