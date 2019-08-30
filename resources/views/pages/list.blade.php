@extends('layouts.app')

@section('header')
    Broadcast List
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Broadcast List</h5>
                    <hr>
                    <form method="POST" action="/settings/list" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Action Type:</label>
                            <div class="col-sm-10">
                                <select name="action" class="form-control">
                                    <option value="" selected disabled>Select Action</option>
                                    <option value="new">New Broadcast List</option>
                                    <option value="add">Add To Current List</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">File:</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control-file" name="list">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Start</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Prepare List</h5>
                    <hr>
                    <form method="POST" action="/settings/list/prepare" class="mr-2 col">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Test Msisdn:</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="msisdn">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Prepare List</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($rows = session('rows'))
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Preparation Result</h5>
                <hr>
                <form>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Rows Before Clean Up:</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="before" value="{{$rows['before']}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Rows After Clean Up:</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="after" value="{{$rows['after']}}" readonly>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection

