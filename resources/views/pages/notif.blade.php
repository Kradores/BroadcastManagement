@extends('layouts.master')

@section('header')
    Notifications
@endsection

@section('content')
    @foreach ($notifs as $notif)
        @if ($notif->notif_marker == 'broadcast_notif_test')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Current Test Notification</h5>
                            <hr>
                            <form method="POST" action="/settings/notif/{{$notif->id}}" accept-charset="UTF-8">
                                @method("PUT")
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" name="notif_text" rows="2">{!! $notif->notif_text !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Current Production Notification</h5>
                            <hr>
                            <form method="POST" action="/settings/notif/{{$notif->id}}" accept-charset="UTF-8">
                                @method("PUT")
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" name="notif_text" rows="2">{!! $notif->notif_text !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endforeach

@endsection
