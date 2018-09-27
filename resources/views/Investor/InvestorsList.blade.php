@extends("layouts.app")

@section('content')


<div class="container">

	<table class="table table-striped">

		<thead>
			<th>Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Address</th>
			<th>phone</th>
			<th>Image</th>
			<th>Action</th>
		</thead>
		<tbody>
			
			@foreach(App\Investor::all() as $investor)
			<tr>
				<td>{{$investor->name}}</td>
				<td>{{$investor->email}}</td>
				<td>{{$investor->mobile}}</td>
				<td>{{$investor->address}}</td>
				<td>{{$investor->phone}}</td>
				<td>
					<img src="{{asset('InvestorImages/'.$investor->image)}}"  height="50px" width="50px">
				</td>
				<td>
					<a href="{{url('edit-investor-form',$investor->id)}}" class="btn btn-primary">edit </a>
					
					<a href="{{url('delete-investor',$investor->id)}}" class="btn btn-danger">delete </a>
					<a href="{{url('investor-detail',$investor->id)}}" class="btn btn-success">detail</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>

@stop
