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
                <div class="card-header">delivery_companies</div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">

                    {!! Form::model($delivery_company, ['method' => 'PATCH','route' => ['delivery-companies.update', $delivery_company->id]]) !!}

                    <div class="form-row">
                        
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('name', 'Company Name') }}
                                    {{ Form::text('name', null, ['placeholder'=>'Company Name', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('type') }}
                                    {{ Form::text('type', null, ['placeholder'=>'Type', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div> 

                        </div>

                        <div class="form-row">
                        
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('cod_charge', 'COD Charge') }}
                                    {{ Form::number('cod_charge', null, ['placeholder'=>'COD Charge', 'step'=>'0.01', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div> 

                        </div>

                        <div class="form-row" id="app">
                        
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('district_and_zone_id', 'Zone') }}
                                    {{ Form::select('district_and_zone_id', $district_and_zones->pluck('zone', 'id'), null, ['class'=>"form-control", 'v-model'=>'district_and_zone_id','required'=>'required']) }}
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('district_and_zone_id', 'District') }}
                                    {{ Form::select('district_and_zone_id', $district_and_zones->pluck('district', 'id'), null, ['class'=>"form-control", 'v-model'=>'district_and_zone_id','required'=>'required', 'disabled']) }}
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

@section('footer_scripts')

<script type="text/javascript" src="https://unpkg.com/vue@2.6.2/dist/vue.js"></script>
<script type="text/javascript">
    var app = new Vue({
        el: '#app',

        data: {
            district_and_zone_id: {{ $delivery_company->district_and_zone_id }},
        },

    });
</script>

@endsection

@endsection