@extends('layouts.master')

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
                    <form>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                {!! Plupload::make([
                                    'url' => '/upload',
                                    'chunk_size' => '1000kb',
                                    'multi_selection' => false,
                                    'headers' => ['action' => 'new'],
                                    ]) 
                                !!}
                            </div>
                            <div class="col-sm-10">
                                <div class="progress" style="height: 38px;">
                                    <div id="upload-progress" class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Prepare List</h5>
                    <hr>
                    <form method="POST" action="/settings/list" class="mr-2 col">
                        @method("PUT")
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Test Msisdn:</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="msisdn">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button id="prepare-button" type="submit" class="btn btn-primary">Prepare List</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="prepare-result" hidden>
        <div class="card-body">
            <h5 class="card-title">Preparation Result</h5>
            <hr>
            <form>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Rows Before Clean Up:</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="before" value="" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Rows After Clean Up:</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="after" value="" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection

