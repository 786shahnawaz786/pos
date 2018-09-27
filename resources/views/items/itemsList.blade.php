@extends('layouts.app')
@section('content')


                <!-- ============================================================== -->
                <!-- Start Page Content -->
  <div class="container-fluid">
  	 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Items list</h4>
                                <div class="table-responsive">
                                    <table class="table v-middle">
                                        <thead>
												<th>Item</th>
												<th>Quantity</th>
												<th>Cost Price</th>
												<th>Sell Price</th>
												<th>Category</th>
												<th>Description</th>
                                                <th>Action</th>
                                        </thead>
                                        <tbody>
											@foreach(App\Item::all() as $item)
											<tr>
												<td><a href="">{{$item->title}}</a></td>
												<td>{{$item->quantity}}</td>
												<td>{{$item->price}}</td>
												<td>{{$item->salePrice}}</td>
												<td>{{App\Category::findorfail($item->category_id)->title}}</td>
												<td>{{$item->description}}</td>
                                                <th>
                                                    <button data-id='{{$item->id}}' onclick="updateSalePrice(this)" class="btn btn-primary" data-toggle='modal' data-target='#updateItem'><i class="mdi mdi-pencil"></i> edit</button>
                                                </th>
											</tr>
											@endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                 </div>
                <!-- ============================================================== -->
               

  <div class="modal fade" id="updateItem" role="dialog">
    <div class="modal-dialog">
        <form  action="{{url('update-item')}}"  method="post">
            
            @csrf
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Update Item</h4>

              <button type="button" class="close" data-dismiss="modal" style="color: red">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="table-control">Item:<span style="color: red"></span></label>
                        <input type="text" id="p_title" readonly="" name="title" required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="table-control">Enter Sale Price :<span style="color: red">*</span></label>
                        <input type="text" id="p_s_price" name="salePrice" required="" class="form-control">

                    </div>
                    <input type="hidden" name="id" id="item_id">

                    <div class="form-group">
                        <label class="table-control">Description:</span></label>
                        <textarea  id="p_desc" class="form-control" rows="5" style="resize: none;" name="description"></textarea>
                    </div>
                    <input type="hidden" id="p_token" name="" value="{{csrf_token()}}">
                </form>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Update</button>
              <button type="button" id="p_dissmiss" class="btn default" data-dismiss="modal">Cancel</button>
            </div>
          </div>
    </form>  
    </div>
 </div>
   </div>

   <script type="text/javascript">
       function updateSalePrice(t) {
        var id = $(t).attr('data-id');
        $.get('{{url("get-item")}}/'+id,function(data){ 
           var data = JSON.parse(data);
           $("#p_title").val(data.title);
           $("#p_s_price").val(data.price);
           $("#p_desc").val(data.description);item_id
           $("#item_id").val(data.id);
        });           
       }
   </script>


@stop