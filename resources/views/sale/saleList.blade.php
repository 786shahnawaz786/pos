@extends('layouts.app')
@section('content')
<style type="text/css">	
.tooltip {
    position: relative;
    display: inline-white;
    border-bottom: 1px dotted black;
}
.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color:green ;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}
</style>
	<div class="container-fluid" style="background: white">
		<h2>Sale's List</h2>
		<table class="table v-middle">
			<thead>
				<th>Customer</th>
				<th>Total Price</th>
				<th>Paid Price </th>
				<th>Balance Due</th>
				<th>Discount</th>
				<th>Expense</th>
				<th>Date</th>
				<th>Detail</th>
				<th><a href="{{url('sale-item')}}" class="btn btn-primary"> <i class="mdi mdi-plus"></i></th>
			</thead>

			<tbody>
				@foreach(App\Sale::all() as $item)
				<tr>
					<td>{{$item->customer_id}}</td>
					<td>{{$item->net_total_price}}</td>
					<td>{{$item->paid_price}}</td>
					<td>{{$item->net_total_price - $item->paid_price}}</td>
					<td>{{$item->total_discount}}</td>
					<td>{{$item->total_expense}}</td>
					<td>{{$item->issueDate}}</td>
					<td><a href="{{url('sale-detail',$item->id)}}" class="btn btn-success"><i class="mdi mdi-send"></i></a></td>

				</tr>
				@endforeach
			</tbody>
			
		</table>
		
	</div>

@stop