@extends('layouts.app')
@section('content')

	<div class="container">
		<table class="table table-striped">
			<thead>
				<th>Order Id</th>
				<th>Issue Date</th>
				<th>Receipt Date</th>
				<th>Tax</th>
				<th>From Location</th>
				<th>To Location</th>
				<th>Action</th>
			</thead>

			<tbody>
				@foreach(App\Order::where("status","complete")->get() as $order)
				<tr>
					@php $r = App\ReceivedStock::where('order_id',$order->id)->first(); @endphp
					<td>{{$order->id}}</td>
					<td>{{$order->issueDate}}</td>
					<td> @php
						if(empty($r) || is_null($r))
						echo $order->receiveDate;
						else
						echo $r->date;
					 @endphp</td>
					<td>{{$order->tax}}</td>
					<td>{{$order->from_loc}}</td>
					<td>{{$order->to_loc}}</td>
					<td><a href="{{url('complete-order-detail',$order->id)}}">Detail</a></td>
				</tr>
				@endforeach
			</tbody>
			
		</table>
		
	</div>

@stop