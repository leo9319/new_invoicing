@extends('layouts.master') 

@section('title', 'Add Discount') 

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
                    {{ Form::open(['route'=>'discounts.store', 'autocomplete'=>'off']) }}

                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('start_date') }}
                                    {{ Form::date('start_date', null, ['class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('end_date') }}
                                    {{ Form::date('end_date', null, ['class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div> 

                        </div>

                        <div id="app">

                            <div class="form-row">
                        
{{--                                 <div class="col-md-6">
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
                                </div>  --}}
    
                            </div>

                            <div class="form-row">

                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        {{ Form::label('name') }}
                                        {{ Form::text('name', null, ['placeholder'=>'Name', 'class'=>"form-control", 'required'=>'required']) }}
                                    </div>
                                </div>
                        
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        {{ Form::label('type') }}
                                        {{ Form::select('type', ['amount'=>'Amount', 'percentage'=>'Percentage'], null, ['placeholder'=>'Select a discount type', 'class'=>"form-control", '@change'=>'OnChangeType($event)', 'required'=>'required']) }}
                                    </div>
                                </div>

                                <discount-amount inline-template v-show="amount">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            {{ Form::label('amount') }}
                                            {{ Form::number('amount', null, ['placeholder'=>'Amount', 'id'=>'amount', 'class'=>"form-control", '@change'=>'OnChangeType($event)']) }}
                                        </div>
                                    </div>
                                </discount-amount>

                                <discount-percentage inline-template v-show="percentage">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            {{ Form::label('percentage') }}
                                            {{ Form::text('percentage', null, ['placeholder'=>'Percentage', 'id'=>'percentage', 'class'=>"form-control", '@change'=>'OnChangeType($event)']) }}
                                        </div>
                                    </div>
                                </discount-percentage>
    
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

    Vue.component('discount-amount', {

    });

    Vue.component('discount-percentage', {

    });

    var app = new Vue({
        el: '#app',

        data: {
            amount: false,
            percentage: false,
            product_id: '',
        },

        methods: {
            OnChangeType() {

                this.amount = false;
                this.percentage = false;
                document.getElementById("amount").required = false;
                document.getElementById("percentage").required = false;

                if(event.target.value == 'amount') {
                    this.amount = true;
                    document.getElementById("amount").required = true;

                } else if(event.target.value == 'percentage') {
                    this.percentage = true;
                    document.getElementById("percentage").required = true;
                }
            }
        }

    });
</script>

@endsection

@endsection