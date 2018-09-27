@extends('layouts.app')

@section('content')


<div class="container-fluid">
	<form action="{{url('show-report-form')}}" method="post"> 
	@csrf	
		<div class="row">
			<div class="col-4">	
				<div class="form-group">
					<label>Start Date :</label>
					<input type="text" class="form-control datePicker" required=""  name="startDate">
				</div>
			</div>
			<div class="col-4">	
				<div class="form-group">
					<label>End Date:</label>
					<input type="text"  name="endDate" class="form-control datePicker" required="">
				</div>
			</div>

			<div class="col-4">
				<label></label>
				<input type="submit" name="genreate" class="form-control btn btn-primary" value="Genreate Report">
			</div>
		</div>
	</form>
</div>

	<script type="text/javascript">
		$(document).ready(function () {
			
			$(".datePicker").datepicker();

		} );
	</script>
@stop