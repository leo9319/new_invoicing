@extends('layouts.master') 

@section('title', 'Sale') 

@section('content')
<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Basic Information</h5>
                    <div class="divider"></div>
                    <div class="row">
                    	<div class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item mt-2"><b>Customer Name: </b>{{ $sale->client_name }}</li>
                                <li class="nav-item mt-2"><b>Address: </b>{{ $sale->client_address }}</li>
                                <li class="nav-item mt-2"><b>Phone:</b> {{ $sale->client_phone }}</li>
                                <li class="nav-item mt-2"><b>Email:</b> {{ $sale->client_email }}</li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item mt-2"><b>Date: </b>{{ Carbon\Carbon::parse($sale->date)->format('d M, Y') }}</li>
                                <li class="nav-item mt-2"><b>Invoice ID: </b>{{ 'IN' . sprintf('%06d', ($sale->id)) }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <h5 class="card-title">Delivery Information</h5>
                    <div class="divider"></div>
                    <div class="row">
                        <div class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item mt-2"><b>Delivery Company Name:</b> {{ $sale->deliveryCompany->companyName->name }}</li>
                                <li class="nav-item mt-2"><b>District: </b>{{ $sale->deliveryCompany->district->district }}</li>
                                <li class="nav-item mt-2"><b>Zone: </b>{{ $sale->deliveryCompany->zone }}</li>
                                <li class="nav-item mt-2"><b>Rate: </b>{{ $sale->deliveryCompany->rate }}</li>
                                <li class="nav-item mt-2"><b>COD Charge: </b>{{ $sale->deliveryCompany->cod_charge }}</li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item mt-2"><b>Handed Over to Delivery Company: </b>{{ $sale->handed_over }}</li>
                                <li class="nav-item mt-2"><b>Delivery Status: </b>{{ $sale->delivered }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="divider"></div>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Product Information</h5>
                    <div class="divider"></div>
                    <div class="row">
                    	@foreach($sale->products as $product)
                        <div class="col">
							<ul class="nav flex-column">
                                <li class="nav-item mt-2"><b>Product Code: </b>{{ 'P' . sprintf('%03d', ($product->id)) }}</li>
                                <li class="nav-item mt-2"><b>Quantity: </b>{{ $product->pivot->quantity }}</li>
                            </ul>
                        </div>
                        <div class="col">
							<ul class="nav flex-column">
                                <li class="nav-item mt-2"><b>Product Name: </b>{{ $product->name }}</li>
                                <li class="nav-item mt-2"><b>Price: </b>{{ $product->pivot->price }}</li>
                            </ul>
                        </div>
                        @endforeach
                    </div>
                    <div class="divider"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Horizontal Menu</h5>
                    <ul class="nav"><a href="javascript:void(0);" class="nav-link active">Link</a><a href="javascript:void(0);" class="nav-link">Link</a><a href="javascript:void(0);" class="nav-link">Another Link</a><a disabled="" href="javascript:void(0);" class="nav-link disabled">Disabled
Link</a></ul>
                    <div class="divider"></div>
                    <div class="nav">
                        <a href="javascript:void(0);" class="nav-link active"><i class="nav-link-icon pe-7s-settings"> </i><span>Link</span></a>
                        <a href="javascript:void(0);" class="nav-link"><i
	class="nav-link-icon pe-7s-wallet"> </i><span>Link</span>
	<div class="badge badge-pill badge-danger">12</div>
</a>
                        <a href="javascript:void(0);" class="nav-link"><span>Another Link</span></a>
                        <a disabled="" href="javascript:void(0);" class="nav-link disabled"><i
	class="nav-link-icon pe-7s-box1"> </i><span>Disabled Link</span></a>
                    </div>
                    <div class="divider"></div>
                    <ul class="nav nav-justified">
                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link active"><i class="nav-link-icon pe-7s-settings"> </i><span>Justified</span></a></li>
                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon pe-7s-chat"> </i><span>Link</span>
	<div class="badge badge-success">NEW</div>
</a></li>
                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><span>Another Link</span></a></li>
                        <li class="nav-item"><a disabled="" href="javascript:void(0);" class="nav-link disabled"><i class="nav-link-icon pe-7s-box1"> </i><span>Disabled Link</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Active Links</h5>
                    <div class="nav nav-pills"><a href="javascript:void(0);" class="nav-link active">Link</a><a href="javascript:void(0);" class="nav-link">Link</a><a href="javascript:void(0);" class="nav-link">Another Link</a><a disabled="" href="javascript:void(0);" class="nav-link disabled">Disabled Link</a></div>
                    <div class="divider"></div>
                    <div class="nav nav-pills"><a href="javascript:void(0);" class="nav-link active"><i class="nav-link-icon pe-7s-settings"> </i><span>Link</span></a><a href="javascript:void(0);" class="nav-link"><i
class="nav-link-icon pe-7s-wallet"> </i><span>Link</span>
<div class="badge badge-pill badge-danger">12</div>
</a><a href="javascript:void(0);" class="nav-link"><span>Another Link</span></a><a disabled="" href="javascript:void(0);" class="nav-link disabled"><i
class="nav-link-icon pe-7s-box1"> </i><span>Disabled Link</span></a></div>
                    <div class="divider"></div>
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link active"><i class="nav-link-icon pe-7s-settings"> </i>Justified</a></li>
                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon pe-7s-chat"> </i>Link
<div class="badge badge-success">NEW</div>
</a></li>
                        <li class="nav-item"><a href="javascript:void(0);" class="nav-link">Another Link</a></li>
                        <li class="nav-item"><a disabled="" href="javascript:void(0);" class="nav-link disabled"><i class="nav-link-icon pe-7s-box1"> </i>Disabled Link</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('footer_scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection