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
                                {{-- <li class="nav-item mt-2"><b>Voucher Discount: </b>{{ $product->voucher->discount_percentage }}%</li> --}}
                                <li class="nav-item mt-2"><b>Total Cost: </b>{{ $product->pivot->price * $product->pivot->quantity }}</li>
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
                                <li class="nav-item mt-2">
                                    <b>Campaign Discount</b>
                                    @if(isset($sale->discount))
                                    ({{ $sale->discount->amount ? 'Flat' : 'Percentage' }})
                                    @endif
                                </li>
                                <li class="nav-item mt-2"><b>Total After Discounts</b></li>
                            </ul>
                        </div>
                        <div class="col">
							<ul class="nav flex-column">
                                <li class="nav-item mt-2">{{ number_format($sale->totalProductPrice(), 2) }}</li>
                                <li class="nav-item mt-2">
                                    @if(isset($sale->discount))
                                    {{ $sale->discount->amount ?? false ? $sale->discount->amount : $sale->discount->percentage }}
                                    {{ $sale->discount->amount ? '' : '%' }}
                                    @else
                                    {{ 'N/A' }}
                                    @endif
                                </li>
                                <li class="nav-item mt-2">{{ $sale->getTotalAfterDiscount() }}</li>
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