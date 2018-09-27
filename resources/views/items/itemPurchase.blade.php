@extends('layouts.app')
@section('content')
<!-- 
add supplier start -->
 <div class="container-fluid">
  	 <div class="row">
  	 	<form method="post" id="myform" action="{{url('save-order')}}">
  	 		@csrf
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title"><center><u>Place Order</u></center></h2>
                                <br>
                                <div>
                                	<div class="row">
                                		<div class="col-4">
                                			<div class="row">
		                                		<label style="display: inline;" class="col-4">Supplier 
		                                		<span style="cursor: pointer;" onclick="" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-account-plus"></i></sapn></label>
		                                		<select class="form-control col-6" name="supplier">
		                                			@foreach(App\Supplier::all() as $sup)
		                                			<option value="{{$sup->id}}">{{$sup->name}}</option>
		                                			@endforeach
		                                		</select>
                                			</div>
                                		</div>
                                		<div class="col-4">
                                			<div class="row">
                                				<label class="col-4 label-control" style="display: inline;">Issue Date</label>
                                		        <input type="text" style="display: inline;" required=""  class="col-8 form-control datePicker" name="issueDate" >
                                			</div>
                                		</div>

                                		<div class="col-4">
                                			<div class="row">
                                				<label class="col-4" style="display: inline;">Expected at:</label>
                                		        <input type="text"  style="display: inline;" required="" class="col-8 form-control datePicker" name="receiveDate" >
                                			</div>
                                		</div>

                                	</div>
                                	<br><br>
                                    <table class="table" id="purchaseTable" style="margin-bottom: 20%">

                                        <thead style="max-width: 100%">
                                                <th>
                                                    <select name="category_id" id="category_id"  onchange="showItems(this)" class="form-control">
                                                        <option>-- select category--</option>
                                                        @foreach(App\Category::all() as $cate)
                                                        <option value="{{$cate->id}}">{{$cate->title}}</option>
                                                        @endforeach
                                                    </select>
                                                 </th>
                                                 <th>
                                                    <button data-toggle='modal' data-target='#addCategory' class="btn btn-standard"> <i class="mdi mdi-cart"></i></button></th>
												<th>
													<select id="slct" class="form-control">
                                                        <option value="0">--select item</option>
													</select>
											    </th>
												<th><input type="number" placeholder="enter quantity.." id="quantity" class="form-control"></th>
												<th><input type="button"  onclick="addItem(this)" class="btn btn-primary" value="Add"><i></i></th>
                                                <th><h3><b>Expense:</b></h3></th>
                                                <th><input type="otherExpense" required="" class="form-control" name="otherExpense"></th>
                                        </thead>
                                        <thead>
                                        	<th>Item</th>
                                        	<th>Qty</th>
                                        	<th>Description</th>
                                        	<th>unit Price</th>
                                        	<th>GST</th>
                                        	<th>Total Price</th>
                                        	<th>Action</th>
                                        	<th><button data-toggle='modal' data-target='#addProcudt' class="btn btn-standard"> <i class="mdi mdi-cart"></i></button></th>
                                        </thead>
                                        <tbody id="tbody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <center>
                            
                        <input type="Submit" class="btn btn-standard"  value="Submit" name="submit">
                        <input type="Submit" name="saveOrder" value="Submit and Print" onclick="changeRoute()" class="btn btn-primary">
                        </center>
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
            <h4 class="modal-title">Add Supplier</h4>

              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="table-control">Name:<span style="color: red">*</span></label>
                        <input type="text" name="name" required="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="table-control">Phone: <span style="color: red">*</span></label>
                        <input type="text" name="phone" required="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="table-control">Address: <span style="color: red">*</span></label>
                        <input type="text" name="address" required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="table-control">Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="table-control">Company</label>
                        <input type="text" name="company" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="Submit" class="btn btn-info">Submit</button>
              <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
            </div>
          </div>
    </form>  
    </div>
 </div>


<!-- 
 add category -->




  <div class="modal fade" id="addCategory" role="dialog">
    <div class="modal-dialog">
        <form>
            @csrf
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Add Category</h4>

              <button type="button" class="close" data-dismiss="modal" style="color: red">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="table-control">title:<span style="color: red">*</span></label>
                        <input type="text" id="c_title" name="title" required="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="table-control">Description:</span></label>
                        <textarea  id="c_desc" class="form-control" rows="5" style="resize: none;" name="description"></textarea>
                    </div>
                    <input type="hidden" id="c_token" name="" value="{{csrf_token()}}">
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" onclick="addCategory()" class="btn btn-info">Submit</button>
              <button type="button" id="c_dissmiss" class="btn default" data-dismiss="modal">Cancel</button>
            </div>
          </div>
    </form>  
    </div>
 </div>

<!-- add suplier close  --><!-- 
            $table->string('title');
            $table->string('description')->nullable();
            $table->double('gst');
            $table->double('price');
            $table->double('quantity');
 -->
<!-- add product start -->


  <div class="modal fade" id="addProcudt" role="dialog">
    <div class="modal-dialog">
        <form  action="{{url('save-product')}}"  method="post">
            @csrf
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Add Product</h4>

              <button type="button" class="close" data-dismiss="modal" style="color: red">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="table-control">title:<span style="color: red">*</span></label>
                        <input type="text" id="p_title" name="title" required="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="table-control">Select Category:<span style="color: red">*</span></label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach(App\Category::all() as $cate)
                            <option value="{{$cate->id}}">{{$cate->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="table-control">Description:</span></label>
                        <textarea  id="p_desc" class="form-control" rows="5" style="resize: none;" name="description"></textarea>
                    </div>
                    <input type="hidden" id="p_token" name="" value="{{csrf_token()}}">
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" onclick="addProcudt()" class="btn btn-info">Submit</button>
              <button type="button" id="p_dissmiss" class="btn default" data-dismiss="modal">Cancel</button>
            </div>
          </div>
    </form>  
    </div>
 </div>
<!-- add product  -->

<script type="text/javascript">

    function addCategory()
    {
        $.post('{{url("save-category-ajax")}}',{title:$("#c_title").val(),description:$("#c_desc").val(),_token:$("#c_token").val()},function(data){  
            
            console.log(data);
            data =JSON.parse(data);
            var op = $("<option>");
            op.val(data.id);
            op.text(data.title);
            op.attr('selected',true);
            $("#category_id").append(op);
            $("#c_dissmiss").click();

        });
    }

	function addProcudt(){

		var title = $("#p_title").val();
		var desc = $("#p_desc").val();
        var category_id = $("#category_id").val();
		var _token = $("#p_token").val();

		if(title =='')
		alert(title);
		else
		{
			$.post('{{url("add-product")}}',{ title: title, description: desc,_token:_token,category_id:category_id},function(data){
			
			var product=JSON.parse(data);
				var op =$("<option selected>");
				op.val(product.id);
				op.text(product.title);
				$("#slct").append(op);
				$("#p_dissmiss").click();
			});
		}

	}
	function addItem(item)
	{
		if($("#quantity").val() ==''||$("#quantity").val() <= 0)
		{
			alert("insert quantity!!");
			return false;
		}

        if($("#slct").val()=='0')
        {
            alert('select item first !!!');
            return false;
        }

	   var thead =$("<tr>");
		var title = $("<input readonly type='text' class='form-control' placeholder='item name' name='title[]'>");
		title.val($("#slct :selected").text());

		var item_id = $("<input type='hidden' name='item_id[]'>");
		item_id.val($("#slct").val());
		
		thead.append($("<td>").append(title));
		 var qty =$("<input  readonly class='form-control' type='number' placeholder='0' value='' name='quantity[]' onfocusout='addQuantity(this)'>");
		 qty.val($("#quantity").val());


		thead.append($("<td>").append(qty));
		thead.append($("<td>").append($("<input type='text' class='form-control' placeholder='Description...' name='description[]'>")));
		thead.append($("<td>").append($("<input type='number' class='form-control'  placeholder='0' name='price[]' onfocusout='addPrice(this)' required>")));
		thead.append($("<td>").append($("<input type='number' class='form-control'  placeholder='0' name='otherExp[]' onfocusout='addExp(this)' required>")));

		thead.append($("<td>").append($("<input type='number' readonly class='form-control' style='width:300%' placeholder='0.00' name='totalPayment[]'>")));

		thead.append($("<td>").append($("<span style='font-size:30px; color:red' class='menus' onclick='menus(this)'>").text("-")));
		thead.append("<td>").append(item_id);
		$("#tbody").append(thead);

        var px=20;
        var count = 0;
        $("#tbody").children().each(function(){

            px =px-5;

        });
        $("#purchaseTable").css('margin-bottom',px+'%');

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

	function addExp(t)
	{
		var gst = $(t).val();
		var p = $(t).parent().prev().children().val();
		var q = $(t).parent().prev().prev().prev().children().val();
		var payment = $(t).parent().next().children();
        if(gst == '' || gst <= 0)
            gst=0;
        payment.val((p*q) + ((q *p)*(gst/100)));
	}
	
	function addPrice(t)
	{

		var p = $(t).val();
		var q = $(t).parent().prev().prev().children().val();
		var gst = $(t).parent().next().children().val();
		var payment = $(t).parent().next().next().children();
        if(gst == '' || gst <= 0)
            gst=0;
        payment.val((p*q) + ((q *p)*(gst/100)));
		
	}
    function changeRoute()
    {

        
            console.log($("#myform").attr('action','order-save-print'));        
    }	

</script>



<script type="text/javascript">
        $(document).ready(function () {
            
            $(".datePicker").datepicker();

        } );
    </script>
</div>
@stop