@extends('layouts.app')
@section('content')
<!-- 
add supplier start -->
 <div class="container-fluid">
  	 <div class="row">
  	 	<form method="post" action="{{url('sale-items')}}">
  	 		@csrf
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title"><center><u><i>Sale Items</i></u></center></h2>
                                <br>
                                <div>
                                	<div class="row">
                                		<div class="col-4">
                                			<div class="row">
		                                		<label style="display: inline;" class="col-4">Customer : 
		                                		<span style="cursor: pointer;"  data-toggle="modal" data-target="#myModal"><i class="mdi mdi-account-plus"></i></sapn></label>
		                                		<select class="form-control col-6" id="Customer_id" name="Customer_id">
		                                			@foreach(App\Customer::all() as $sup)
		                                			<option value="{{$sup->id}}">{{$sup->name}}</option>
		                                			@endforeach
		                                		</select>
                                			</div>
                                		</div>
                                		<div class="col-4">
                                			<div class="row">
                                				<label class="col-4 label-control" style="display: inline;">Issue Date</label>
                                		        <input type="text" style="display: inline;" required="" id="datepicker" class="col-8 form-control datePicker" name="issueDate" >
                                			</div>
                                		</div>
                                	</div>
                                	<br><br>
                                    <table class="table v-middle" id="purchaseTable" style="margin-bottom: 15%">

                                        <thead >
                                                <th>
                                                    <select name="category_id" id="category_id"  onchange="showItems(this)" class="form-control">
                                                        <option>-- select category--</option>
                                                        @foreach(App\Category::all() as $cate)
                                                        <option value="{{$cate->id}}">{{$cate->title}}</option>
                                                        @endforeach
                                                    </select>
                                                 </th>
												<th>
													<select id="slct" class="form-control">
                                                        <option value="0">--select item</option>
													</select>
											    </th>
												<th><input type="button"  onclick="addItem(this)" class="btn btn-primary" value="Add"><i></i></th>
                                                <th><h3><b>Expense:</b></h3></th>
                                                <th><input type="otherExpense" required="" class="form-control" name="otherExpense"></th>
                                                <th><input type="checkbox"   id="flat_discount" onclick="flat(this)"> <span>Qty Discount</span></th>
                                        </thead>
                                        <thead>
                                        	<th>Item</th>
                                        	<th>Stock Qty</th>
                                        	<th>Sale Qty</th>
                                        	<th>Unit Price</th>
                                        	<th style="display: none;" class="t_t_td">Discount %</th>
                                        	<th>Total Price</th>
                                        	<th>Action</th>
                                        </thead>
                                        <tbody id="tbody">

                                        	<tfoot style="color: green; display:none;" id="t_foot">
                                        		<tr>
                                        			<th></th>
                                        			<th></th>
                                        			<th></th>
                                        			<th></th>
                                        			<th>Gross Total:</th>
                                        			<th><input type="text"  name="total_price" id="total_price" class="form-control"></th>
                                        			<th><input type="text" class="form-control" placeholder="Discount %" name="total_discount" onfocusout="addTotalDiscount()" id="total_discount"></th>
                                        		</tr>

                                        		<tr>
                                        			<th></th>
                                        			<th></th>
                                        			<th></th>
                                        			<th></th>
                                        			<th>Net Total :</th>
                                        			<th><input type="text" onfocusout='setNetTotal()'  name="net_total_price" id="net_total_price" class="form-control"></th>
                                        		</tr>

                                        		<tr>
                                        			<th></th>
                                        			<th></th>
                                        			<th></th>
                                        			<th></th>
                                        			<th>Paid Price :</th>
                                        			<th><input type="text"  onfocusout="padPrice()"  required="" name="paid_price"  class="form-control" id="paid_price"></th>
                                        		</tr>

                                        		<tr>
                                        			<th></th>
                                        			<th></th>
                                        			<th></th>
                                        			<th></th>
                                        			<th>Balance Due :</th>
                                        			<th><input type="text" name="" class="form-control" id="balance_due"></th>
                                        		</tr>
                                        	</tfoot>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    	<input type="Submit" name="saveOrder" value="Submit" class="btn btn-primary col-12 form-control">
                    </div>

  	 	</form>
     </div>
                <!-- ============================================================== -->

  </div>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <form  action="{{url('save-supplier')}}"  method="post">
            @csrf
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Add Customer</h4>

              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label class="table-control">Name:<span style="color: red">*</span></label>
                        <input type="text" name="name" id="c_name" required="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="table-control">Phone: <span style="color: red">*</span></label>
                        <input type="text" name="phone" id="c_phone" required="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="table-control">Address: <span style="color: red">*</span></label>
                        <input type="text" name="address" id="c_address" required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="table-control">Email:</label>
                        <input type="email" name="email" id="c_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="table-control">Company</label>
                        <input type="text" name="company" id="c_company" class="form-control">
                    </div>
            </div>
            <input type="hidden" id="c_token" name="" value="{{csrf_token()}}">
            <div class="modal-footer">
              <button type="button" onclick="saveCustomer()" class="btn btn-info">Submit</button>
              <button type="button" class="btn default" id="c_dissmiss" data-dismiss="modal">Cancel</button>
            </div>
          </div>
    </form>  
    </div>
 </div>
<script type="text/javascript">

	function flat(t)
	{ 
		if ($(t).is(':checked'))
		{
			$(".t_t_td").show();
		}
		else
		{
			$(".t_t_td").hide();

		}

	}

	function saveCustomer()

	{
		$.post('{{url("ajax-save-customer")}}',{name:$("#c_name").val(),phone:$("#c_phone").val(),address:$("#c_address").val(),email:$("#c_email").val(),_token:$("#c_token").val(),company:$("#c_company").val()},function(data){
			data = JSON.parse(data);
			console.log(data);
			var op = $("<option selected>");
			op.text(data.name);
			op.val(data.id);
			$("#Customer_id").append(op);
			$("#c_dissmiss").click();

		});
	}

	function addItem(item)
	{

        if($("#slct").val()=='0')
        {
            alert('select item first !!!');
            return false;
        }

        var i_id = $("#slct").val();
        $.get('{{url("get-item")}}/'+i_id,function(data){
        	var data  = JSON.parse(data);


        	var signal  = false;

		$("#tbody").children().each(function(){
			if($(this).attr('id') == data.id)
			{
				alert('This item is already exsist !!');
				signal = true;
				return false;
			}
		});
		
		if(signal)
			return false;

	   var thead =$("<tr>");
		var title = $("<input readonly type='text' class='form-control' placeholder='item name' name='title[]'>");
		title.val($("#slct :selected").text());

		var item_id = $("<input type='hidden' name='item_id[]'>");
		item_id.val($("#slct").val());
		
		thead.append($("<td>").append(title));
		 var sqty =$("<input  readonly class='form-control'  style='color:green' type='number' placeholder='0' value='' name='squantity[]' readonly>");
		 sqty.val(data.quantity);

		 var qty =$("<input class='form-control' type='number' placeholder='0' value='' name='quantity[]' onfocusout='addQty(this)'>");
		 qty.val(data.quantity);


		thead.append($("<td>").append(sqty));
		thead.append($("<td>").append(qty));
		var sp = $("<input type='number' class='form-control'  placeholder='0' name='price[]' onfocusout='addPrice(this)' required>");
		sp.val(data.salePrice);
		thead.append($("<td>").append(sp));
        var q_diss = $("<input type='number' class='form-control'  placeholder='%' name='q_discount[]' onfocusout='addExp(this)'>");
        q_diss.val(0);
		thead.append($("<td class='t_t_td' style='display:none'>").append(q_diss));
		 var t = data.salePrice*data.quantity;
		var tt = $("<input type='number' readonly class='form-control t_t_t'  placeholder='0.00' onchange='t_p_get(this)' name='totalPayment[]'>");
		tt.val(t);
		thead.append($("<td>").append(tt));

		thead.append($("<td>").append($("<strong style='font-size:30px; color:red' class='menus' onclick='menus(this)'>").text("-")));
		thead.append("<td>").append(item_id);
		thead.attr('id',data.id);
		$("#tbody").append(thead);
		$("#t_foot").show();

        $("#total_price").val(t);
        $("#net_total_price").val(t);
        })
	}
//	
    
    function showItems(me)
    {
        var id = $(me).val();
        $.get('{{url("get-items")}}/'+id,function(data){
          data= JSON.parse(data);
          $("#slct").empty();
          $("#slct").append($("<option value='0'>").text('--Select Item--'));
          for(var x in data)
          {
            var item = data[x];
            var op = $("<option>");
            op.val(item.id)
            op.text(item.title);
            $("#slct").append(op);
          }
      });
 }


	function menus(t)
	{
		var title = $(t).parent().prev().prev().prev().prev().prev().prev().children();

		$( "#secret" ).children().each(function(index) {		
		  if( title.val() == $(this).text())
		  {
		  	$(this).remove();
		  
			}
		});
		
		$(t).parent().parent().remove();
	}

	function addQty(t)
	{
		var q = $(t).val();
		var p = $(t).parent().next().children().val();
		var gst = $(t).parent().next().next().children().val();
		var payment = $(t).parent().next().next().next().children();
        if(gst == '' || gst <= 0)
            gst=0;

        payment.val((p*q) - ((q *p)*(gst/100)));
        t_p_get();
	}

	function t_p_get()
	{
		var total =0;
		$(".t_t_t").each(function(){
			total = total +parseInt($(this).val());
		});
		console.log();
		$("#total_price").val(total);
		addTotalDiscount();
		padPrice();

	}

	function addExp(t)
	{
		var gst = $(t).val();
		var p = $(t).parent().prev().children().val();
		var q = $(t).parent().prev().prev().children().val();
		var payment = $(t).parent().next().children();
        if(gst == '' || gst <= 0)
            gst=0;
        payment.val((p*q) - ((q *p)*(gst/100)));
        t_p_get();

	}
	function addPrice(t)
	{

		var p = $(t).val();
		var q = $(t).parent().prev().children().val();
		var gst = $(t).parent().next().children().val();
		var payment = $(t).parent().next().next().children();
        if(gst == '' || gst <= 0)
            gst=0;
        payment.val((p*q) - ((q *p)*(gst/100)));
        t_p_get();
	}	

	function addTotalDiscount()
	{
		var d =0.0; 
		if(!($("#total_discount").val() == '' || $("#total_discount").val() == 0))
		 d = parseFloat($("#total_discount").val());
		var g_total = parseFloat($("#total_price").val());
		var net_total =g_total - (g_total * (d/100)); 
		$("#net_total_price").val(net_total);
		padPrice();
	}

	function padPrice()
	{

		var n_t =$("#net_total_price").val();
		var p_p = $("#paid_price").val();
		$("#balance_due").val(n_t- p_p);
	}
</script>


    <script type="text/javascript">
        $(document).ready(function () {
            
            $(".datePicker").datepicker();

        } );
    </script>
</div>
@stop