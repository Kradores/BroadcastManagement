@extends('layouts.app')

@section('header')
    Test SMS
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Launch Test</h5>
                <hr>
                <form method="POST" action="/settings/test" accept-charset="UTF-8">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <input class="form-control" name="msisdn" rows="2" placeholder="Msisdn">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Send SMS</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Get Last Test SMS Result</h5>
                <hr>
                <form method="POST" action="/settings/test" accept-charset="UTF-8">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <input class="form-control" name="msisdn" rows="2" placeholder="Msisdn">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Send Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if ($sms = session('sms')[0])
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Last Test SMS Result</h5>
                    <hr>
                    <form method="GET" action="/settings/test/{{$sms->id}}" accept-charset="UTF-8">
                        <div class="form-group row">
                            <label for="smsId" class="col-sm-2 col-form-label">SMS ID:</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="smsId" value="{{$sms->id}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="msisdn" class="col-sm-2 col-form-label">Msisdn:</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="msisdn" value="{{$sms->dst_adress}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text" class="col-sm-2 col-form-label">Text:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="text" readonly>{{$sms->text}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status:</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="status" value="{{$sms->status}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="datetime" class="col-sm-2 col-form-label">DateTime Sent:</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="datetime" value="{{$sms->send_date}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary float-right">Refresh</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
