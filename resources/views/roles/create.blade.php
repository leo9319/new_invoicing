@extends('layouts.master') 

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
                    {{ Form::open(['route'=>'users.store', 'autocomplete'=>'off']) }}

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('role_name') }}
                                    {{ Form::text('name', null, ['placeholder'=>'Full Name', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="col-md-12">
                                {{ Form::label('permissions') }}
                            </div>

                        </div>

                        <div class="form-row">

                            @foreach($permission as $value)

                                <div class="col-md-6">
                                    <div class="position-relative form-check">
                                        <label>
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'form-check-input')) }}{{ $value->name }}
                                        </label>
                                    </div>
                                </div>

                            @endforeach

                        </div>

                        {{ Form::submit('Create', ['class'=>"mt-3 mr-2 btn btn-success btn-lg btn-block"]) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection