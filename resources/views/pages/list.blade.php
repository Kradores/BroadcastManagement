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
                            <label class="col-sm-2 col-form-label">File Name:</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="smsId" class="col-sm-2 col-form-label">File:</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control-file" name="list">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
