@extends('layouts.master') 

@section('title', 'Create Delivery Company') 

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
                    {{ Form::open(['route'=>'delivery-companies.store', 'autocomplete'=>'off']) }}

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

                        {{ Form::submit('Create', ['class'=>"mt-3 mr-2 btn btn-success btn-lg btn-block"]) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection