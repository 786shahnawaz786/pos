@extends('layouts.app')
@section('content')

<div class="container-fluid" style="background: white">
	<h2>Sale's  Detail List</h2>
	<div class="row">
		<div class="col-3"><label>total Sale :</label> <strong>{{$sale->net_total_price}}</strong></div>
		<div class="col-3"><label>total Discount % :</label> <strong>{{$sale->total_discount}}</strong></div>
		<div class="col-3"><label>total Paid :</label> <strong>{{$sale->paid_price}}</strong></div>
		<div class="col-3"><label>Balance :</label> <strong>{{$sale->net_total_price}}</strong></div>
	</div>
	<table class="table v-middle">
		<thead>
			<th>Item</th>
			<th>Qty</th>
			<th>price</th>
			<th>Qty Discount</th>
			<th>Created at</th>
		</thead>
		<tbody>
			@foreach(App\SaleDetail::where('sale_id',$sale->id)->get() as $sd)
			<tr>
				<td>{{App\Item::findorfail($sd->item_id)->title}}</td>
				<td>{{$sd->qty}}</td>
				<td>{{$sd->price}}</td>
				<td>{{$sd->qty_discount}}</td>
				<td>{{$sd->created_at}}</td>
			</tr>
			@endforeach
		</tbody>
		
	</table>

</div>






@stop