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
                    {{ Form::open(['route'=>'products.store', 'autocomplete'=>'off']) }}

                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('code', 'Product Code') }}
                                    {{ Form::text('code', null, ['placeholder'=>'Product Code', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('name', 'Product Name') }}
                                    {{ Form::text('name', null, ['placeholder'=>'Product Name', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div> 

                        </div>

                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('size', 'Product Size') }}
                                    {{ Form::text('size', null, ['placeholder'=>'Product Size', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('brand_id', 'Brand') }}
                                    {{ Form::select('brand_id', $brands->pluck('name', 'id'), null, ['class'=>"form-control", 'required'=>'required']) }}
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