@extends('layouts.master') 

@section('title', 'Create Invoice') 

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
                    {{ Form::open(['route'=>'sales.store', 'autocomplete'=>'off']) }}

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('date', 'Date') }}
                                    {{ Form::date('date', Carbon\Carbon::now(), ['class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('voucher_id', 'Voucher') }}
                                    {{ Form::select('voucher_id', $vouchers->pluck('influencer_code', 'id'), null, ['placeholder'=>'Select a Voucher', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('discount_id', 'Discount') }}
                                    {{ Form::select('discount_id', $discounts->pluck('name', 'id'), null, ['placeholder'=>'Select a Discount', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('client_name', 'Name') }}
                                    {{ Form::text('client_name', null, ['placeholder'=>'Full Name', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('client_phone', 'Phone') }}
                                    {{ Form::number('client_phone', null, ['placeholder'=>'Phone', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('client_address', 'Address') }}
                                    {{ Form::text('client_address', null, ['placeholder'=>'Address', 'class'=>"form-control", 'required'=>'required']) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    {{ Form::label('client_email', 'Email') }}
                                    {{ Form::email('client_email', null, ['placeholder'=>'Email', 'class'=>"form-control"]) }}
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div id="app">
                            <product-container></product-container>
                        </div>

                        {{ Form::submit('Create', ['class'=>"mt-3 mr-2 btn btn-success btn-lg btn-block"]) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@section('footer_scripts')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/vue@2.6.2/dist/vue.js"></script>
<script type="text/javascript">

    Vue.component('product-container', {
        template: `<h1>Test</h1>`
    });

    var app = new Vue({
        el: '#app',

        data: {
            product_id: '',
            quantity: '',
        },

        methods: {
            onProductChange() {
                axios.get('/get-product', {
                params: {
                  id: this.product_id
                }
              })
                .then(function (response) {

                })
                .catch(error => alert(error));
            }
        }

    });
</script>

@endsection

@endsection