<?php

namespace App\Http\Controllers;

use App\Events\NotificationUpdatedEvent;
use App\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notif_marker = [
            'broadcast_notif_test',
            'broadcast_notif'
        ];
        $notifs = Notification::whereIn('notif_marker', $notif_marker)->get();

        return view("pages.notif")->with('notifs', $notifs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $notif = Notification::find($id);

        if($notif->notif_text === $request->input('notif_text')) {
            return back()->with('notice', "Sorry, I will not update current text with same text!");
        }

        $notif->notif_text = $request->input('notif_text');

        if($notif->save()) {
            return back()->with('success', 'Notification Updated');
        }

        return back()->with('error', 'Notification Updated With Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
