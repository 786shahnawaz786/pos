@extends('layouts.app')
@section('content')

	<div class="container-fluid" style="background: white">
		<h2 style="display: inline;">Pending Orders</h2>
		<a href="{{url('place-order')}}" class="btn btn-success " style="margin-left: 60%"> <i class="mdi mdi-plus"></i></a>
		<br><br>
		<table class="table" id="myTable">
			<thead>
				<th>Order Id</th>
				<th>Supplier</th>
				<th>Issue Date</th>
				<th>Receipt Date</th>
				<th>Detail</th>
			</thead>

			<tbody>
				@foreach(App\Order::where("status","pending")->get() as $order)
				<tr>
					<td>{{$order->id}}</td>
					<td><?php if($order->supplier_id > 0) {$supplier =App\Supplier::findorfail($order->supplier_id)->name; echo $supplier;
					 } 
					 else
					 	echo "direct purchase";

					 ?></td>
					<td>{{$order->issueDate}}</td>
					<td>{{$order->receiveDate}}</td>
					<td><a href="{{url('order-detail',$order->id)}}" class="btn btn-info"><i class="mdi mdi-send"></i></a></td>
				</tr>
				@endforeach
			</tbody>
			
		</table>
	</div>


	<script type="text/javascript">
		$(document).ready(function () {
			
		    $('#myTable').DataTable();
		} );
	</script>
@stop