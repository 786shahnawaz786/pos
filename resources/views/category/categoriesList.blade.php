@extends('layouts.app')
@section('content')
                <!-- ============================================================== -->
                <!-- Start Page Content -->

  <div class="container-fluid">
@if (Session::has('message'))
   <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif
<br>
  	 <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="display: inline;">Categories list</h4>
                                <button data-toggle='modal'data-target='#addCategory'>Add New</button>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
												<th>Title</th>
                                                <th>Description</th>
                                        </thead>
                                        <tbody>
											@foreach(App\Category::all() as $item)
											<tr>
                                                <td>{{$item->title}}</td>
												<td>{{$item->description}}</td>
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
               
   </div>

  <div class="modal fade" id="addCategory" role="dialog">
    <div class="modal-dialog">
        <form  action="{{url('save-category')}}"  method="post">
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
                        <input type="text" id="p_title" name="title" required="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="table-control">Description:</span></label>
                        <textarea  id="p_desc" class="form-control" rows="5" style="resize: none;" name="description"></textarea>
                    </div>
                    <input type="hidden" id="p_token" name="" value="{{csrf_token()}}">
                </form>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info">Submit</button>
              <button type="button" id="p_dissmiss" class="btn default" data-dismiss="modal">Cancel</button>
            </div>
          </div>
    </form>  
    </div>
 </div>

@stop