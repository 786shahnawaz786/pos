@extends('layouts.app')
@section('content')
<div class="container">
	<table class="table table-striped">
		<thead>
			<th>Order Id : {{$order->id}}</th>
			<th>Issue Date :{{$order->issueDate}}</th>
			<th>Receive Date : <span style="color: green">{{App\ReceivedStock::where('order_id',$order->id)->first()->date}}</span></th>
			<th>Status : <span style="color: green;">{{$order->status}}</span></th>
			<th>From : <span style="color: green">{{$order->from_loc}}</span></th>
			<th>To : <span style="color: green">{{$order->to_loc}}</span></th>
		</thead>
	</table>
	<table class="table table-success">
		<thead>
			<th>Item</th>
			<th>Orderd Qty</th>
			<th>Received Qty</th>
			<th>Description</th>
			<th>Cost</th>
			<th>Price</th>
		</thead>

		
			@foreach(App\Purchase::where('order_id',$order->id)->get() as $ord)
			<tr>
				<td>{{$ord->title}}</td>
				<td>{{$ord->quantity}}</td>
				<td>{{App\ReceivedStock::where('order_id',$order->id)->first()->date}}</td>
				<td>{{$ord->description}}</td>
				<td>{{$ord->expense}}</td>
				<td>{{$ord->totalPayment}}</td>
				
			</tr>

			@endforeach
	</table>

</div>
@stop