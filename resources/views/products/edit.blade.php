@extends('layouts.master') 

@section('title', 'Edit Product') 

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
                <div class="card-header">Edit Products</div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">

                    {!! Form::model($product, ['method' => 'PATCH','route' => ['products.update', $product->id]]) !!}

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

                            {{ Form::submit('Update', ['class'=>"mt-3 mr-2 btn btn-info btn-lg btn-block"]) }}

                        </div>

                    {!! Form::close() !!}

                </div>

                <div class="d-block text-center card-footer">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection