@extends('layouts.app')
@section('content')


<div class="container-fluid">
	<table class="table v-middle">
		<thead>
			<th>Order Id : {{$order->id}}</th>
			<th>Issue Date :{{$order->issueDate}}</th>
			<th>Receive Date : <span style="color: green">{{$order->receiveDate}}</span></th>
			<th>Status : <span style="color: green;">{{$order->status}}</span></th>
			<th>From : <span style="color: green">{{$order->from_loc}}</span></th>
			<th>To : <span style="color: green">{{$order->to_loc}}</span></th>
		</thead>
	</table>
	<table class="table v-middle" style="background: white">
		<thead>
			<th>Item</th>
			<th>Qty</th>
			<th>GST</th>
			<th>Price</th>
		</thead>		
			@foreach(App\Purchase::where('order_id',$order->id)->get() as $ord)

			<tr>
				<td>{{$ord->title}}</td>
				<td>{{$ord->quantity}}</td>
				<td>{{$ord->expense}}</td>
				<td>{{$ord->totalPayment}}</td>
				
			</tr>

			@endforeach
	</table>

</div>
@stop