@extends('layouts.master') 

@section('title', 'Sale') 

@section('content')
<div class="app-main__inner">
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
            		<h5 class="card-title">Cancelled Delivery</h5>
                    <div class="row">
                    	<div class="col">
                    		<form method="POST" action="{{ route('sales.store_returned_products') }}">
                    			@csrf
                    			<table class="table">
								  <thead>
								    <tr>
								      <th scope="col">Product ID</th>
								      <th scope="col">Product Name</th>
								      <th scope="col">Quantity</th>
								      <th scope="col">Price</th>
								      <th scope="col">Returned</th>
								      <th scope="col">Damaged</th>
								    </tr>
								  </thead>
								  <tbody>
								  	@foreach($sale->products as $product)
								  	@if($product->pivot->returned == NULL)
								  	<input type="hidden" name="ids[]" value="{{ $product->pivot->id }}">
								    <tr>
								      <th scope="row">{{ $product->code }}</th>
								      <td>{{ $product->name }}</td>
								      <td>{{ $product->pivot->quantity }}</td>
								      <td>{{ $product->pivot->price }}</td>
								      <td>
								      	<input type="number" class="form-control w-auto" name="returned[]" min="0" max="{{ $product->pivot->quantity }}">
								      </td>
								      <td>
								      	<input type="number" class="form-control w-auto" name="damaged[]" min="0" max="{{ $product->pivot->quantity }}">
								      </td>
								    </tr>
								    @endif
								    @endforeach
								  </tbody>
								</table>
								<button type="submit" class="btn btn-success btn-block">Update</button>
                    		</form>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection 

@section('footer_scripts')

@endsection