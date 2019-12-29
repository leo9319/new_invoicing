@extends('layouts.master') 

@section('title', 'Edit District') 

@section('content')

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

<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">District</div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">

                    {!! Form::model($district, ['method' => 'PATCH','route' => ['districts.update', $district->id]]) !!}
                    <div class="form-row">

                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                {{ Form::label('district') }}
                                {{ Form::text('district', null, ['placeholder'=>'District', 'class'=>"form-control", 'required'=>'required']) }}
                            </div>
                        </div>

                    </div>

                    {{ Form::submit('Update', ['class'=>"mt-3 mr-2 btn btn-info btn-lg btn-block"]) }}

                    {!! Form::close() !!}

                </div>

                <div class="d-block text-center card-footer">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection