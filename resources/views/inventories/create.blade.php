@extends('layouts.master') 

@section('title', 'Create Inventory')

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
                    {{ Form::open(['route'=>'inventories.store', 'autocomplete'=>'off']) }}

                        <div id="app">

                            <div class="form-row">
                        
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        {{ Form::label('code', 'Product Code') }}
                                        {{ Form::select('product_id', $products->pluck('code', 'id'), null, ['placeholder'=>'Product Code', 'class'=>"form-control", 'v-model'=>'product_id', 'required'=>'required']) }}
                                    </div>
                                </div> 
    
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        {{ Form::label('name', 'Product Name') }}
                                        {{ Form::select('product_id', $products->pluck('name', 'id'), null, ['placeholder'=>'Product Name', 'class'=>"form-control", 'v-model'=>'product_id', 'required'=>'required']) }}
                                    </div>
                                </div> 
    
                            </div>
    
                            <div class="form-row">
    
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        {{ Form::label('quantity') }}
                                        {{ Form::number('quantity', null, ['placeholder'=>'Quantity', 'class'=>"form-control", 'required'=>'required']) }}
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        {{ Form::label('mrp') }}
                                        {{ Form::number('mrp', null, ['placeholder'=>'MRP', 'class'=>"form-control", 'step'=>'0.1', 'required'=>'required']) }}
                                    </div>
                                </div>
    
                            </div>

                        </div>

                        {{ Form::submit('Add', ['class'=>"mt-3 mr-2 btn btn-success btn-lg btn-block"]) }}

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
            product_id: '',
        },

    });
</script>

@endsection

@endsection