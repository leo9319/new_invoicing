@extends('layouts.master') 

@section('title', 'Create Invoice') 

@section('header_scripts')

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

@endsection

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
                    
                    {{ Form::open(['route'=>'sales.store', 'autocomplete'=>'off']) }}

                    <div class="d-flex justify-content-between"><h5 class="card-title">Please provide the necessary information</h5>
                    
                        <div class="row">
                            <div class="pt-2"><label class="font-weight-bold">Paid in advance?</label></div>
                            <div class="col-md-2">
                                <input name="advance_payment" type="checkbox" data-toggle="toggle" id="advance-payment">
                            </div>
                        </div>

                    </div>

                    <div id="app">
                        <div class="form-row">
                    
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('date', 'Date') }}
                                    {{ Form::date('date', Carbon\Carbon::now(), ['class'=>"form-control", 'required'=>'required', 'readonly']) }}
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    {{ Form::label('voucher_id', 'Voucher') }}
                                    {{ Form::select('voucher_id', $vouchers->pluck('influencer_code', 'id'), null, ['placeholder'=>'Select a Voucher', 'class'=>"form-control"]) }}
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
                                        {{ Form::number('quantity[]', null, ['placeholder'=>'Quantity', 'class'=>"form-control", "required"]) }}
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
                                        {{ Form::label('remarkss', 'MRP') }}
                                        {{ Form::text('remarkss[]', null, ['placeholder'=>'Remark', 'v-model'=>'invoice_product.remarks', 'class'=>"form-control"]) }}
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <button type='button' class="btn btn-danger btn-block" v-if="index > 0" @click="deleteRow(index, invoice_product)">Remove Product</button>
                        </div>

                        <button type='button' class="btn btn-info btn-block mt-2" @click="addNewRow">Add More Product</button>

                        {{ Form::submit('Create', ['class'=>"mt-3 mr-2 btn btn-success btn-lg btn-block"]) }}
                    </div>

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

    var app = new Vue({
        el: '#app',

        data: {
            invoice_products: [{
                product_id: '',
                mrp: '',
                remarks: ''
            }],
            company: 0,
            district: 0,
            zone: 0,
            company_names: [],
            districts: [],
            zones: [],
        },

        methods: {

            addNewRow() {
                this.invoice_products.push({
                    product_id: '',
                    mrp: '',
                    remarks: ''
                });
            },

            deleteRow(index, invoice_product) {
                var idx = this.invoice_products.indexOf(invoice_product);
                if (idx > -1) {
                    this.invoice_products.splice(idx, 1);
                }
            },

            onProductChange(invoice_product) {
                axios.get({!! json_encode(route('get_product')) !!}, {
                    params: {
                      id: invoice_product.product_id
                    }
                })
                .then(response => invoice_product.mrp = response.data.mrp)
                .catch(error => alert(error));
            },

            onCompanyNameChange() {
                axios.get({!! json_encode(route('get_district')) !!})
                .then(response => this.districts = response.data)
                .catch(error => alert('No district found!'));
            },

            onDistrictChange() {
                axios.post({!! json_encode(route('get_zone')) !!}, {
                    company_name_id: this.company,
                    district_id: this.district,
                })
                .then(response => this.zones = response.data)
                .catch(error => alert('No zone found!'));
            }
        },

        mounted() {
            axios.get({!! json_encode(route('get_company')) !!})
            .then(response => this.company_names = response.data)
            .catch(error => alert('No company has been found!'));
        }

    });
</script>
<script type="text/javascript">
    $('#advance-payment').bootstrapToggle({
        on: 'Yes',
        off: 'No',
        onstyle: 'success',
        style: 'border'
    });
</script>

@endsection

@endsection