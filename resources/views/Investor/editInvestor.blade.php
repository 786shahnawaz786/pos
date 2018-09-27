@extends('layouts.app')
@section('content')
<div class="container">
	<form action="{{action('AdminController@updateInvestor',$investor->id)}}" method="post" enctype="multipart/form-data">
		@csrf
	  <div class="form-group row">
	    <label for="inputName" class="col-sm-2 col-form-label">Name <span>*</span></label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name="name" required id="inputName" value="{{$investor->name}}"  placeholder="Name...">
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="inputEmail" class="col-sm-2 col-form-label">Email <span>*</span></label>
	    <div class="col-sm-10">
	      <input type="email" name="email" required class="form-control" value="{{$investor->email}}" id="inputEmail" placeholder="Email...">
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="inputMobile"  class="col-sm-2 col-form-label">Mobile <span>*</span></label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="inputMobile" value="{{$investor->mobile}}"  required name="mobile" placeholder="Mobile...">
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="inputAddress"  class="col-sm-2 col-form-label">Address <span>*</span></label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="inputAddress" required name="address" placeholder="Addesss..." value="{{$investor->address}}">
	    </div>
	  </div>


	  <div class="form-group row">
	    <label for="inputPhone"  class="col-sm-2 col-form-label">Phone </label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="Phone..." value="{{$investor->phone}}">
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="inputPhone"  class="col-sm-2 col-form-label">Image </label>
	    <div class="col-sm-10">
			<input type="file" value="{{$investor->image}}" name="image" id="profile-img" >
				<img src="{{asset('InvestorImages/'.$investor->image)}}" id="profile-img-tag" width="200px" />
	    </div>
	  </div>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
</script>


	  <div class="form-group row">
	  	<div class="col-sm-4"></div>
	    <div class="col-sm-4">
	      <input type="submit" class="form-control btn btn-primary" id="inputPhone" name="submit" placeholder="Phone...">
	    </div>
	  </div>
	</form>

</div>

@stop