@extends('layouts.app')
@section('content')
 <div class="container-fluid">
  	 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div style="margin: 2%; width: 100%">

                                <h4 class="card-title" style="display: inline; width: 60%">Customers</h4>
                                <button type="button" style="margin-left: 70%" class="btn btn-info btn-sm push-right" data-toggle="modal" data-target="#myCustomer"><i class="mdi mdi-account-plus"></i></button>
                                
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <table class="table" id="myCustomer">
                                        <thead>
												<th>Name</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Address</th>
												<th>Company</th>
                                                <th>Action</th>

                                        </thead>
                                        <tbody>
                                            @foreach(App\Customer::all() as $customer)
                                            <tr>
                                                <td>{{$customer->name}}</td>
                                                <td>{{$customer->email}}</td>
                                                <td>{{$customer->phone}}</td>
                                                <td>{{$customer->adddress}}</td>
                                                <td>{{$customer->company}}</td>
                                                <td>
                                                    <a href="" class="btn btn-info"><i class="mdi mdi-pencil-box-outline"></i><span class="hide-menu"></span></a>
                                                    <a href="" class="btn btn-dangers"><i class="mdi mdi-account-remove btn btn-danger"></i><span></span></a>
                                                    <a href="">
                                                        <i class="mdi mdi-account-card-details btn btn-success"></i>
                                                    </a>
                                                </td>
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

    <script type="text/javascript">
        $(document).ready(function () {

            $("#myCustomer").DataTable();
        } );
    </script>
@stop