@extends('layouts.master') 

@section('title', 'Create Brand Manager') 

@section('content')

<div class="app-main__inner">
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                           @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                      </div>
                    @endif
                    <h5 class="card-title">Please provide the necessary information</h5>
                    {{ Form::open(['route'=>'brand-users.store', 'autocomplete'=>'off']) }}

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('user_id', 'Manager Name') }}
                                    {{ Form::select('user_id', $brand_users->pluck('name', 'id'), null, ['class'=>"form-control select2", 'required'=>'required']) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('brand_ids', 'Brands') }}
                                    {{ Form::select('brand_ids[]', $brands->pluck('name', 'id'), null, ['class'=>"form-control", "multiple", 'required'=>'required']) }}
                                </div>
                            </div>

                        </div>

                        {{ Form::submit('Set', ['class'=>"mt-3 mr-2 btn btn-success btn-lg btn-block"]) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection