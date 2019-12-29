@extends('layouts.master') 

@section('title', 'Edit Delivery Company') 

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
                <div class="card-header">Tests</div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">

                    {!! Form::model($deliveryCompany, ['method' => 'PATCH','route' => ['delivery-companies.update', $deliveryCompany->id]]) !!}
                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('company_name_id', 'Company Name') }}
                                    {{ Form::select('company_name_id', $company_names->pluck('name', 'id'), null, ['placeholder'=>'Select a Company', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('district_id', 'District') }}
                                    {{ Form::select('district_id', $districts->pluck('district', 'id'), null, ['placeholder'=>'Select a District', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('zone', 'Zone') }}
                                    {{ Form::text('zone', null, ['placeholder'=>'Zone', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('rate') }}
                                    {{ Form::number('rate', null, ['placeholder'=>'Rate', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('cod_charge') }}
                                    {{ Form::number('cod_charge', null, ['placeholder'=>'COD Charge', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('type') }}
                                    {{ Form::text('type', null, ['placeholder'=>'Type', 'class'=>"form-control", 'required'=>'required']) }}
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