@extends('layouts.master')

@section('header')
    Broadcast Start/Stop
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Broadcast Status</h5>
                    <hr>
                    <div class="row">
                        <form method="GET" action="/settings/status/start" class="mr-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Start</button>
                            </div>
                        </form>
                        <form method="GET" action="/settings/status/stop" class="mr-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Stop</button>
                            </div>
                        </form>
                        <form method="GET" action="/settings/status/current" class="mr-2 col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info float-right">Get Status</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @if (session('start'))
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Broadcast Status</h5>
                        <hr>
                        <div class="row">
                            <p>Started at {{session('start')}} <br> Active for {{session('duration')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @endif
@endsection