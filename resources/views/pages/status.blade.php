@extends('layouts.app')

@section('header')
    Broadcast Start/Stop
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Broadcast List</h5>
                    <hr>
                    <div class="row">
                        <form method="GET" action="/settings/status/start" class="mr-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Start</button>
                            </div>
                        </form>
                        <form method="GET" action="/settings/status/stop" class="mr-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Stop</button>
                            </div>
                        </form>
                        <form method="GET" action="/settings/status/current" class="mr-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Get Status</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection