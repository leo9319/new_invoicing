@extends('layouts.master') 

@section('title', 'Create Invoice') 

@section('header_scripts')

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

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
                                    {{ Form::select('voucher_id', $vouchers->pluck('influencer_code', 'id'), null, ['placeholder'=>'Select a Voucher', 'class'=>"form-control select2"]) }}
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

                        <div class="form-group">

                            {{ Form::label('company_name_id', 'Delivery Company Name') }}
                            {{ Form::select('company_name_id', $company_names->pluck('name', 'id'), null, ['id'=>'company-name-id', 'class'=>'company-name form-control select2', 'placeholder'=>'Select a Company Name']) }}
                        
                        </div>

                        <div class="form-group">

                            {{ Form::label('company_district_id', 'Delivery Company District') }}
                            {{ Form::select('company_district_id', $company_districts->pluck('district', 'id'), null, ['id'=>'company-district-id', 'class'=>'form-control select2', 'placeholder'=>'Select a District']) }}
                            
                        </div>

                        <div class="form-group">

                            {{ Form::label('delivery_company_id', 'Delivery Company Zone') }}
                            {{ Form::select('delivery_company_id', [], null, ['id'=>'company-zone', 'class'=>'form-control select2', 'placeholder'=>'Select a Zone', 'id'=>'zones']) }}
                            
                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
            
                                    {{ Form::label('product_id', 'Product Code') }}

                                    <select name="product_id[]", class="product-code form-control select2", required="required">
                                        <option>Select product code</option>
                                        @foreach($inventories as $inventory)
                                        <option value="{{ $inventory->product->id }}">{{ $inventory->product->code }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
            
                                    {{ Form::label('product_name', 'Product Name') }}

                                    <select name="product_name[]", class="product-name form-control select2", required="required">
                                        <option>Select product name</option>
                                        @foreach($inventories as $inventory)
                                        <option value="{{ $inventory->product->id }}">{{ $inventory->product->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                
                                <div class="form-group">
    
                                    {{ Form::label('quantity') }}
                                    {{ Form::number('quantity[]', null, ['class'=>'quantity form-control', 'placeholder'=>'Quantity', 'required']) }}
                                    
                                </div>
                                
                            </div>
    
                            <div class="col-md-6">
    
                                <div class="form-group">
    
                                    {{ Form::label('mrp') }}
                                    {{ Form::text('mrp[]', null, ['class'=>'mrp form-control', 'readonly']) }}
                                    
                                </div>
                                
                            </div>

                            <div class="col-md-12">
    
                                <div class="form-group">
    
                                    {{ Form::label('remark') }}
                                    {{ Form::text('remark[]', null, ['class'=>'form-control']) }}
                                    
                                </div>
                                
                            </div>

                        </div>

                        <div id="product-container"></div>

                        <button type="button" class="add btn btn-block btn-info mt-2">Add More Product</button>

                        {{ Form::submit('Create', ['class'=>"mt-3 mr-2 btn btn-success btn-lg btn-block"]) }}
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@section('footer_scripts')

<script type="text/javascript">

    $('#advance-payment').bootstrapToggle({
        on: 'Yes',
        off: 'No',
        onstyle: 'success',
        style: 'border'
    });     

    $(document).ready(function() {

        $('.select2').select2({
            placeholder: "Select an option"
        });

        remove();
        setPrice();
    
        $(".add").click(function() {
            
            var productHTML = `

                <div class="select2-container">

                    <div class="row">
    
                        <div class="col-md-6">
    
                            <div class="form-group">
    
                                {{ Form::label('product_id', 'Product Code') }}

                                <select name="product_id[]", class="product-code form-control select2a", required="required">
                                    <option>Select product code</option>
                                    @foreach($inventories as $inventory)
                                    <option value="{{ $inventory->product->id }}">{{ $inventory->product->code }}</option>
                                    @endforeach
                                </select>

                                
                            </div>
    
                        </div>
    
                        <div class="col-md-6">
    
                            <div class="form-group">
    
                                {{ Form::label('product_name', 'Product Name') }}

                                <select name="product_name[]", class="product-name form-control select2", required="required">
                                    <option>Select product name</option>
                                    @foreach($inventories as $inventory)
                                    <option value="{{ $inventory->product->id }}">{{ $inventory->product->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            
                        </div>
    
                        <div class="col-md-6">
    
                            <div class="form-group">
    
                                {{ Form::label('quantity') }}
                                {{ Form::number('quantity[]', null, ['class'=>'quantity form-control', 'placeholder'=>'Quantity', 'required']) }}
                                
                            </div>
                            
                        </div>
    
                        <div class="col-md-6">
    
                            <div class="form-group">
    
                                {{ Form::label('mrp') }}
                                {{ Form::text('mrp[]', null, ['class'=>'mrp form-control', 'readonly']) }}
                                
                            </div>
                            
                        </div>
    
                        <div class="col-md-12">
    
                            <div class="form-group">
    
                                {{ Form::label('remark') }}
                                {{ Form::text('remark[]', null, ['class'=>'form-control']) }}
                                
                            </div>
                            
                        </div>
    
                        <div class="col">
                            
                            <button type="button" class="remove btn btn-block btn-danger mt-2 mb-2">Remove This Product</button>
    
                        </div>
    
                    </div>

                </div>
    
            `;

            var productContainer = $('#product-container');

            productContainer.append(productHTML);

            $('#product-container .select2:last').select2();
            $('#product-container .select2a:last').select2();
            

            remove();
            setPrice();
            
        });

    });

    $("#company-district-id").change(function() {

        var companyNameId = $("#company-name-id").val();
        var companyDistrictId = $("#company-district-id").val();
        var zones = '';

        $.ajax({
          type: 'get',
          url: '{!!URL::to('getCompanyZone')!!}',
          data: {
            'company_name_id'    : companyNameId,
            'company_district_id': companyDistrictId,
          },
          success:function(data){

            for(var i = 0; i < data.length; i++) {

                zones += '<option value="'+data[i].id+'">'+data[i].zone+'</option>';

            }

            document.getElementById('zones').innerHTML = zones;
                 
          },
          error:function(){

          }
        }); 
        
    });

    function setPrice() {

        $(".product-code").change(function() {

            var mrp = $(this).parent().parent().parent().find('.mrp');
            mrp.val('');
            var productId = $(this).val();

            if($(this).parent().parent().parent().find('.product-name').val() != productId) {
                $(this).parent().parent().parent().find('.product-name').select2('val', productId);
            }

            $.ajax({
                type: 'get',
                url: '{!!URL::to('getInventoryInfo')!!}',
                data: {'product_id': productId},
                success:function(data) {
                    mrp.val(data.mrp);
                },
                error:function(){
                    // do nothing
                }
            });
            
        });

        $(".product-name").change(function() {

            var mrp = $(this).parent().parent().parent().find('.mrp');
            mrp.val('');
            var productId = $(this).val();

            if($(this).parent().parent().parent().find('.product-code').val() != productId) {
                $(this).parent().parent().parent().find('.product-code').select2('val', productId);
            }

            $.ajax({
                type: 'get',
                url: '{!!URL::to('getInventoryInfo')!!}',
                data: {'product_id': productId},
                success:function(data) {
                    mrp.val(data.mrp);
                },
                error:function(){
                    // do nothing
                }
            });
            
        });

    }

    function remove() {
        $(".remove").click(function() {
            $(this).parent().remove();
        });
    }

</script>

@endsection

@endsection