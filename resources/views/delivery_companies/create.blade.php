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
                                    {{ Form::text('cod_charge', null, ['placeholder'=>'COD Charge', 'class'=>"form-control", 'required'=>'required']) }}
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

                        {{ Form::submit('Create', ['class'=>"mt-3 mr-2 btn btn-success btn-lg btn-block"]) }}

                    {{ Form::close() }}
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
            district_and_zone_id: '',
        },

    });
</script>

@endsection

@endsection