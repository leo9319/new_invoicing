@extends('layouts.master') 

@section('title', 'Sale') 

@section('content')
<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                	<div class="d-flex justify-content-between align-items-end">
                		<h5 class="card-title">Basic Information</h5>
                		<button class="btn btn-success">Update Status</button>
                	</div>
                    
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
                                <li class="nav-item mt-2"><b>Voucher Code: </b>{{ $sale->voucher->influencer_code ?? '' }}</li>
                                <li class="nav-item mt-2"><b>Discount Campaign Name: </b>{{ $sale->discount->name ?? '' }}</li>
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
                                <li class="nav-item mt-2"><b>Handed Over to Delivery Company: </b>{{ $sale->handed_over ?? 'N/A' }}</li>
                                <li class="nav-item mt-2"><b>Delivery Status: </b>{{ $sale->delivered ?? 'N/A' }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="divider"></div>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Orders <div class="badge badge-pill badge-info">{{ count($sale->products) }}</div></h5>
                    <div class="divider"></div>
                    @foreach($sale->products as $product)
                    <div class="row">
                        <div class="col">
							<ul class="nav flex-column">
                                <li class="nav-item mt-2"><b>Product Code: </b>{{ 'P' . sprintf('%03d', ($product->id)) }}</li>
                                <li class="nav-item mt-2"><b>Quantity: </b>{{ $product->pivot->quantity }}</li>
                                <li class="nav-item mt-2 mb-2"><b>Remarks: </b>{{ $product->pivot->remarks }}</li>
                            </ul>
                        </div>
                        <div class="col">
							<ul class="nav flex-column">
                                <li class="nav-item mt-2"><b>Product Name: </b>{{ $product->name }}</li>
                                <li class="nav-item mt-2"><b>Price: </b>{{ $product->pivot->price }}</li>
                            </ul>
                        </div>
                        <div class="col">
							<ul class="nav flex-column">
                                <li class="nav-item mt-2"><b>Total Cost: </b>{{ number_format($product->pivot->quantity * $product->pivot->price), 2 }}</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Invoice Total</h5>
                    <div class="divider"></div>
                    <div class="row">
                        <div class="col">
							<ul class="nav flex-column">
                                <li class="nav-item mt-2"><b>Total Product Cost:</b></li>
                                <li class="nav-item mt-2"><b>Voucher Discount ({{ $sale->voucher->discount_percentage ?? 0 }}%)</b></li>
                                <li class="nav-item mt-2"><b>Campaign Discount ({{ $sale->discount->percentage ?? 0 }}%)</b></li>
                                <li class="nav-item mt-2"><b>Total After Discounts</b></li>
                            </ul>
                        </div>
                        <div class="col">
							<ul class="nav flex-column">
                                <li class="nav-item mt-2">{{ number_format($sale->totalProductPrice(), 2) }}</li>
                                <li class="nav-item mt-2"></li>
                                <li class="nav-item mt-2"></li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection @section('footer_scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection