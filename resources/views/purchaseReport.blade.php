<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="{{asset('/report/style.css')}}">
		<script src="{{asset('/report/script.js')}}"></script>
		<style type="text/css">
		.btn
		{
			    display: inline-block;
				padding: 9px 12px;
				padding-top: 7px;
				margin-bottom: 0;
				font-size: 14px;
				line-height: 20px;
				color: #5e5e5e;
				text-align: center;
				vertical-align: middle;
				cursor: pointer;
				background-color: #d1dade;
				-webkit-border-radius: 3px;
				-webkit-border-radius: 3px;
				-webkit-border-radius: 3px;
				background-image: none !important;
				border: none;
				text-shadow: none;
				box-shadow: none;
				transition: all 0.12s linear 0s !important;
				font: 14px/20px "Helvetica Neue",Helvetica,Arial,sans-serif;

		}
		</style>
	</head>
	<body>
		<header>
			<h1>Invoice</h1>
		</header>
		<article>
			<h1>Recipient</h1>
			<address content>
							<span style=""><img alt="" src="{{asset('/sora.jpg')}}"></span>
			</address>
			<table class="meta">
				<tr>
					<th><span content>Invoice #</span></th>
					<td><span content>{{$order->InvoiceNo}}</span></td>
				</tr>
				<tr>
					<th><span content>Issue Date</span></th>
					<td><span content>{{$data->issueDate}}</span></td>
				</tr>
				<tr>
					<th><span content>Expected Date</span></th>
					<td><span content>{{$data->receiveDate}}</span></td>
				</tr>
				<tr>
					<th><span>Supplier </span></th>
					<td><span>{{App\Supplier::findorfail($order->supplier_id)->name}}</span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span content>Item</span></th>
						<th><span content>Quantity</span></th>
						<th><span content>GST Cost</span></th>
						<th><span content>Price <span style=" color: green">(Rs)</span></span></th>
					</tr>
				</thead>
				<tbody>

					<?php $total = 0; ?>
					@foreach($data->item_id as $key=>$d)
					<tr>
						<td><span content>{{$data->title[$key]}}</span></td>
						<td><span content>{{$data->quantity[$key]}}</span></td>
						<td><span data-prefix></span><span>{{$data->otherExp[$key]}}</span></td>
						<td><span data-prefix></span><span>{{$data->price[$key]}}</span></td>
					  <?php  $total = $total + $data->price[$key]; ?>

					</tr>
					@endforeach
				</tbody>
			</table>
			<table class="balance">
				<tr>
					<th><span content>Total</span></th>
					<td><span data-prefix></span><span>{{$total}}</span></td>
				</tr>

			</table>
		</article>
		 <center>
			<a href="{{url('pending-orders')}}" onclick="myFunction()" class="btn">Save</a>
		 </center>
	</body>
</html>

<script>
function myFunction() {
    window.print();
}
</script>