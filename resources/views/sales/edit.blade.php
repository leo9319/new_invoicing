@extends('layouts.master') 

@section('title', 'Edit Sale') 

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

                    {!! Form::model($sale, ['method' => 'PATCH','route' => ['sales.update', $sale->id]]) !!}
                    
                    <div id="app">
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
                                    {{ Form::select('voucher_id', $vouchers->pluck('influencer_code', 'id'), null, ['placeholder'=>'Select a Voucher', 'class'=>"form-control"]) }}
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('discount_id', 'Discount') }}
                                    {{ Form::select('discount_id', $discounts->pluck('name', 'id'), null, ['placeholder'=>'Select a Discount', 'class'=>"form-control"]) }}
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

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('company_name') }}
                                    <select class="form-control" v-model="company" @change="onCompanyNameChange" required>
                                        <option v-for="(company_name, index) in company_names" :value="company_name.id" :key="index" v-text="company_name.name"></option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="col-md-12" v-if="company != 0">
                                <div class="position-relative form-group">
                                    {{ Form::label('district') }}
                                    <select class="form-control" v-model="district" @change="onDistrictChange" required>
                                        <option v-for="(district, index) in districts" :value="district.id" :key="index" v-text="district.district"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12" v-if="district != 0">
                                <div class="position-relative form-group">
                                    {{ Form::label('delivery_company_id', 'Zone') }}
                                    <select class="form-control" v-model="zone" name="delivery_company_id" required>
                                        <option v-for="(zone, index) in zones" :value="zone.id" :key="index" v-text="zone.zone"></option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div v-for="(invoice_product, index) in invoice_products" :key="index">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        {{ Form::label('product_id', 'Product') }}
                                        {{ Form::select('product_id[]', $products->pluck('name', 'id'), null, ['placeholder'=>'Product Name', 'v-model'=>'invoice_product.product_id', '@change'=>"onProductChange(invoice_product)", 'class'=>"form-control", "required"]) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        {{ Form::label('quantity', 'Quantity') }}
                                        {{ Form::text('quantity[]', null, ['placeholder'=>'Quantity', 'class'=>"form-control", "required"]) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        {{ Form::label('mrp', 'MRP') }}
                                        {{ Form::text('mrp[]', null, ['placeholder'=>'MRP', 'v-model'=>'invoice_product.mrp', 'class'=>"form-control", "readonly"]) }}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        {{ Form::label('remark', 'MRP') }}
                                        {{ Form::text('remark[]', null, ['placeholder'=>'Remark', 'v-model'=>'invoice_product.remark', 'class'=>"form-control"]) }}
                                    </div>
                                </div>

                                <hr>

                            </div>

                            <button type='button' class="btn btn-danger btn-block" v-if="index > 0" @click="deleteRow(index, invoice_product)">Remove Product</button>
                        </div>

                        <button type='button' class="btn btn-info btn-block mt-2" @click="addNewRow">Add More Product</button>

                        {{ Form::submit('Create', ['class'=>"mt-3 mr-2 btn btn-success btn-lg btn-block"]) }}
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