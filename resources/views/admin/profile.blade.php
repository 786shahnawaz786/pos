@extends('layouts.app')
@section('content')

<?php 
$user  = App\User::findorfail(Auth::user()->id);

 ?>
 <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">My Profile</h4>
                    </div>
                    <div class="col-7">
                    </div>
                </div>
            </div>
            @if(session()->has('success'))
            <div class="alert alert-success" id="alert_id">
              <strong>{{session()->pull('success', 'default')}}</strong> 
            </div>

            @endif
            <div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="{{asset('assets/images/users/5.jpg')}}" class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10">{{$user->name}}</h4>
                                    <h6 class="card-subtitle"></h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium"></font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium"></font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6>{{$user->email}}</h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6>{{$user->phone}}</h6> <small class="text-muted p-t-30 db">Address</small>
                                <h6>{{$user->address}}</h6>
                                <div class="map-box">
                                    <iframe style="display: none;"></iframe>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" action="{{url('update-user')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name <span style="color: red">*</span></label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="shah nawaz" value="{{$user->name}}" required="" name="name" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email<span style="color: red">*</span></label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="johnathan@admin.com" required="" class="form-control form-control-line" name="email" id="example-email" value="{{$user->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Phone No <span style="color: red">*</span></label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="123 456 7890" value="{{$user->phone}}" name="phone" required="" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Message</label>
                                        <div class="col-md-12">
                                            <textarea rows="2" style="resize: none;" name="message" class="form-control form-control-line">{{$user->message}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-12"> Address</label>
                                            <input type="text" value="{{$user->address}}" placeholder="71 Pilgrim Avenue Chevy Chase, MD 20815" name="address" class="form-control form-control-line">
                                        <div class="col-sm-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

            </div>

 <script type="text/javascript">
     
    setTimeout(function(){ 
        $("#alert_id").hide();
     }, 3000);
 </script>
@stop