@extends('layouts.app')
@section('content')
	<div class="container-fluid">
		<br>
		<br>
		<br>
		<table>
			<thead>
				<th>Invoice #: 
					<select id="or_id" class="form-control" onchange="getOrder(this)">
						<option>select</option>
					@foreach(App\Order::where('status','pending')->get() as $order)
					<option value="{{$order->id}}">{{$order->InvoiceNo}}</option>
					@endforeach</select>
				</th>
				<th></th>
				<th></th>
				<th></th>
				<th>
					<label>Date:</label>
					<input type="text" id="showDate" onfocusout="setDate()" class="form-control datePicker">
				</th>
				<th>
					<label>Supplier :</label>
					<input type="hidden"  name="supplier_id"  id="supp">
					<input type="text" id="suppli"  class="form-control" readonly>
				</th>

				<th><label>Other Expenses </label><input class="form-control" type="text"  name="otherExpense" value="" id="other_exp"></th>
			</thead>
		</table>
		<br><br>
		<form  action="{{action('ItemController@receivePurchase')}}" id="myform" method ="post">
			@csrf
			<input type="hidden"  id="order_id" name="order_id" >
		<table class="table table-success">
			<thead>
				<th>Item</th>
				<th>Qty</th>
				<th>Description</th>
				<th>GST</th>
				<th>Price</th>
				<th>Line Total</th>
			</thead>
			<tbody id="orderDetail">
			</tbody>
			<br><br>
			<tfoot style="background: white">
				<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th>Total Price :</th>
				<th><input type="text"  class="form-control"   id="totalPrice" name="totalPrice"></th>
				</tr>
				<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th>Paid Price :</th>
				<th><input type="text"  class="form-control" id="paidPrice" onfocusout="grandTotal()" name="paidPrice"></th>
				</tr>

				<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th>Balance Due :</th>
				<th><input type="text"   class="form-control" id="balanceDue" name="balanceDue" onfocusout =grandTotal()></th>
				</tr>

			</tfoot>
		</table>
		<hr>
		<input type="hidden" id='hiddenDate' value="{{date("m-d-Y")}}"  name="receiveDate">
		<input type="submit" id="onlySubmit"  name="onlySubmit" class="btn btn-default">
		<input type="submit" name="submit" value="submit and Print Report" onclick ="subAndPrint()" id="subAndr" class="btn btn-primary">
		</form>
	</div>

	<script type="text/javascript">

		function setDate()
		{
			console.log($("#showDate").val());
			$("#hiddenDate").val();
		}

		function subAndPrint()
		{
			console.log($("#myform").attr('action','report-form'));			
		}

		function getOrder(t){
			var id = $(t).val();
			$.get("{{url('get-order')}}/"+id,function(data){
			
				var order =JSON.parse(data);
				var sup = order["s"];
				var o = order["o"];
				$("#other_exp").val(o.otherExpense);
				ord = order["p"];
				var total =0;

				 $("#orderDetail").empty();		
				for(x in ord)
				{

					order= ord[x];	

					var price = parseInt(order.totalPayment);
					var q= parseInt(order.quantity);
					var gst= parseInt(order.expense);
					var r = (price*q) + ((q *price)*(gst/100));
			   total =total +r;
				 var tr ="<tr> <td><input type='hidden' readonly value='"+order.item_id+"' name='item_id[]'><input tyep='text' readonly class='form-control'value='"+order.title+"' name='title[]'></td> <td><input type='number' class='form-control qty' data-id='"+order.quantity+"' onfocusout='getquantity(this)' value='"+order.quantity+"' name='quantity[]'></td> <td><input type='text' class='form-control' value='"+order.description+"' name='description[]'></td> <td><input type='number' value='"+order.expense+"'name='expense[]' onfocusout='gLine(this)' class='form-control exp'></td> <td><input type='number' name='price[]' value='"+order.totalPayment+"' onfocusout='pLine(this)' class='form-control'><input type ='hidden' value='"+order.id+"' name='p_id[]'> </td> <td><input type ='number'  readonly class='form-control' value ='"+r+"'> </td> </tr>";
				console.log(order);			
				 $("#orderDetail").append(tr);

				}
				total =total + parseInt($("#other_exp").val());
				$("#order_id").val(id);
				$("#supp").val(sup.id);
				$("#suppli").val(sup.name);
				$('#totalPrice').val(total);
				
			});

		}

		function grandTotal()
		{
		   var tp=$("#totalPrice").val();
		   var pt=$("#paidPrice").val();
		   var bt=$("#balanceDue").val(parseInt(tp) - parseInt(pt));

		}
		function getquantity(t)
		{
			
			var orignal = $(t).attr('data-id');
			var get_value = $(t).val();
			
			if((orignal < get_value)|| get_value <= 0)
			{
				alert("Quantity shoud be greater than ! 0  and less than! "+orignal);
				$(t).val(orignal);
				
			}

		lineTotal('q',$(t));
		}
		function gLine(t)
		{
			lineTotal('g',$(t));
		}
		
		function pLine(t)
		{
			lineTotal('p',$(t));
		}
		function lineTotal(v, t)
		{
			var r = null;
			var price =0;
			var gst=0;
			var q =0;
			if(v =='q')
			{
			 price =parseInt($(t).parent().next().next().next().children().val());
			 gst =parseInt($(t).parent().next().next().children().val());
			 q = parseInt($(t).val());
			 r =$(t).parent().next().next().next().next().children();
			}
			else if(v=='g')
			{
			 price =parseInt($(t).parent().next().children().val());
			 q =parseInt($(t).parent().prev().prev().children().val());
			 gst = parseInt($(t).val());

			 r =$(t).parent().next().next().children();
			}
			else
			{
			 q=parseInt($(t).parent().prev().prev().prev().children().val());
			 gst=parseInt($(t).parent().prev().children().val());
			 price = parseInt($(t).val());
			 r =$(t).parent().next().children();
			}
			 if(gst == '' || gst == 0)
			 	gst =0;

			 r.val((price*q) + ((q *price)*(gst/100)));

		}
		function menus(t)
		{
			$(t).parent().paorent().remove();
		}
	</script>


	<script type="text/javascript">
		$(document).ready(function () {
			
			$(".datePicker").datepicker();

		} );
	</script>
@stop