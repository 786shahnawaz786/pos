@extends('layouts.app')
@section('content')
	<div class="container">
		<form  action="{{action('ItemController@saleStock')}}" method ="post">
			@csrf
		<table class="table table-striped">
			<thead>
				<th></th>
				<th></th>
				<th>Sale Date : <input type="date" name="date" required=""></th>
			</thead>
			<thead>
				<th>Customer : <input type="text" name="customer" required="">    </th>
			</thead>
			</tbody>
		</table>

		<table class="table table-success">
			<thead>
				<th>Item</th>
				<th>Sell Qty</th>
				<th>Price</th>
				<th>Description</th>
				<th>Stock Qty</th>
				<th>Warn Qty</th>
				<th>Line Total</th>
				<th><button onclick="addRow()" type="button">+</button></th>
			</thead>
			<tbody id="saleDetail">

			</tbody>
		</table>
		<hr>
		<input type="submit" name="submit" class="btn btn-primary form-control">
		</form>
	</div>

	<script type="text/javascript">

		function addRow(){
			var select = $("<select onchange='getItemValues(this)' name='title[]'>");
			var option = $("<option>");
			option.val(0);
			option.text('--select--');

			select.append(option);
			getItemList(select);
			var title = $("<th>").append($(select));
			var qty = $("<th>").append($("<input type ='number' name ='quantity[]' onfocusout='showQty(this)'>"));
			var price = $("<th>").append($("<input readonly name='price[]'>"));
			var dec = $("<th>").append($("<input type='text' required name=description[]>"));
			var qtyStock = $("<th>").append($("<input readonly name='stockQty[]'>"));
			var warnQty = $("<th>").append($("<input   readonly value='0' name='warnQty[]'>"));
			var lineTotal = $("<th>").append($("<input >"));
			
			var id =  $("<th>").append($("<input type='hidden' name='id[]'>"));
			var row = $("<tr>");
			row.append(title);
			row.append(qty);
			row.append(price);
			row.append(dec);
			row.append(qtyStock);
			row.append(warnQty);
			row.append(lineTotal);

			row.append(id);

			$("#saleDetail").append(row);
		}
	function getItemValues(t){


				var id =$(t).val();
				if(id==0)
				{
					return false;
				}
			    $.ajax({
               type:'Get',
               url:'sale-stock-form/getItem/'+ id,
               success:function(data){

               	var title =data['title'];
               	var qty =data['quantity'];
               	var price =data['price'];
               	var gst =data['gst'];
               	var dec =data['description'];
               	var id_item = data['id'];
               	$(t).parent().next().children().attr('placeholder','0');
               	$(t).parent().next().children().attr('data-id',qty);

               	$(t).parent().next().next().children().val(price);
               	$(t).parent().next().next().children().attr('data-id',price);


               	$(t).parent().next().next().next().children().val(dec);

               	

               	$(t).parent().next().next().next().next().children().val(qty);
               	$(t).parent().next().next().next().next().next().next().next().children().val(id_item);
               	
               },
			});P
		}


	function getItemList(t){
			    $.ajax({
               type:'Get',
               url:'sale-stock-form/getItemList',
               success:function(data){
               	for(x in data)
               	{
               		var op =$("<option>");
               		op.val(data[x]['id']);
               		op.text(data[x]['title']);
               		op.attr('data-id',data[x]['title']);
               		$(t).append(op);

               	}
               },
               error:function(data)
               {
               	console.log(data);
               }
			});
		}

		function showQty(t){
			var q = $(t).val();
			var o_q = $(t).attr('data-id');

			 var p =$(t).parent().next().children();
			 var line_total =$(t).parent().next().next().next().next().next().children();

			if( q >o_q)
			{
				alert("Quantity entered greater than stock");
				$(t).val(0);
			  line_total.val(0);
			}
			else
			{
			 line_total.val(p.val()*q);
			}
		}
	</script>
@stop