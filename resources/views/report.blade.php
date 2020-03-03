<!DOCTYPE html>
<html>
<head>
	<title>Export</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>Invoice No</th>
				<th>Invoice Date</th>
				<th>Campaign</th>
				<th>Name</th>
				<th>Address</th>
				<th>Phone No</th>
				<th>Email</th>
				<th>Delivery Company</th>
				<th>Delivery Zone</th>
				<th>Delivery District</th>
				<th>Delivery Type</th>
				<th>Product Name</th>
				<th>Product Code</th>
				<th>Quantity</th>
				<th>Rate</th>
				<th>Total Price</th>
				<th>Discount</th>
				<th>Delivery Charge</th>
				<th>Total Price + Delivery Charge - Discount</th>
			</tr>
		</thead>
		<tbody>
		@foreach($sales as $index => $sale)
			
			@php 
				$quantity = 0;
				$product_names = array();
				$product_codes = array();
				$product_mrps  = array();
			@endphp

			@foreach($sale->products as $product)
				@php
					$product_names[] = $product->name;
					$product_codes[] = $product->code;
					$product_mrps[]  = $product->pivot->price;
					$quantity       += $product->pivot->quantity - $product->pivot->returned;
				@endphp
			@endforeach

			<tr>
				<td>{{ 'IN' . sprintf('%06d', ($sale->id)) }}</td>
				<td>{{ Carbon\Carbon::parse($sale->date)->format('d/m/y') }}</td>
				<td>{{ $sale->discount->name ?? 'N/A' }}</td>
				<td>{{ $sale->client_name }}</td>
				<td>{{ $sale->client_address }}</td>
				<td>{{ $sale->client_phone }}</td>
				<td>{{ $sale->client_email }}</td>
				<td>{{ $sale->deliveryCompany->companyName->name }}</td>
				<td>{{ $sale->deliveryCompany->zone }}</td>
				<td>{{ $sale->deliveryCompany->district->district }}</td>
				<td>{{ $sale->deliveryCompany->type }}</td>
				<td>{{ implode(", ", $product_names) }}</td>
				<td>{{ implode(", ", $product_codes) }}</td>
				<td>{{ $quantity }}</td>
				<td>{{ implode(", ", $product_mrps) }}</td>
				<td>{{ $sale->totalProductPrice() }}</td>
				@if(isset( $sale->discount))
				<td>{{ $sale->discount->amount ?? $sale->discount->percentage }}</td>
				@else
				<td></td>
				@endif
				<td>{{ $sale->deliveryCompany->rate }}</td>
				<td>{{ $sale->totalSaleAfterDeliveryAndDiscount() }}</td>
			</tr>
			
			@php
				unset($product_names);
				unset($product_codes);
				unset($product_mrps);
			@endphp

		@endforeach
		</tbody>
	</table>
</body>
</html>