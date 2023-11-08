@extends('layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">User</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <!-- Profile Image -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>
                        </div>
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?php if ($user->avatar != "") { ?>
                                    <img class="profile-user-img img-fluid img-circle" style="width:128px;height:128px;" src="{{ $user->avatar }}" title="{{ $user->full_name }}" alt="Profile Image">
                                <?php } else { ?>
                                    <img class="profile-user-img img-fluid img-circle" style="width:128px;height:128px;" src="{{ asset('assets/avatar.png') }}" title="{{ $user->full_name }}" alt="Profile Image">
                                <?php } ?>
                            </div>
                            <h3 class="profile-username text-center">{{ $user->first_name }}</h3>
                            
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>First Name</b><a class="float-right"> {{ $user->first_name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Last Name</b><a class="float-right"> {{ $user->last_name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b><a class="float-right"> {{ $user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Emergency Number</b><a class="float-right"> {{ $user->emergency_number }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Latitude</b><a class="float-right"> {{ $user->lat }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>longitude</b><a class="float-right"> {{ $user->lang }}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right"><?php echo ($user->is_active == 1 ? "<label class='badge badge-success'>ACTIVE</label>" : "<label class='badge badge-danger'>DEACTIVE</label>"); ?></a>
                                </li>
                            </ul>
                            <?php $lock = ($user->is_active == 1 ? "fas fa-lock-open" : "fas fa-lock"); ?>
                            <a href="{{ url('admin/user/status/'.$user->id) }}" class="btn btn-block {{ $user->is_active==1?"btn-primary":"btn-danger" }} ajax" title="Change Status"><b> {{ $user->is_active==0?"Click to Activate":"Click to Deactivate" }} <i class="{{ $lock }}"></i></b></a>

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                    
                </div>
                <div class="col-12 col-sm-12 col-md-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12 col-sm-6 col-lg-12">
                            @if ($user->license_images->count() == 0)
                            <h2 style="text-align:center">No License Images </h2>
                            @else
                            <h2 style="text-align:center">License Images </h2>
                            @foreach($user->license_images as $img)
                              <img src="{{ asset($img->license_image) }}" class="img img-thumbnail" style="width: 230px; height: 240px">
                            @endforeach
                            @endif
                            


                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>



                <!-- /.col -->
            </div>
            
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('additional_scripts')

<script>
    
</script>
<script>
    $(function() {

    });
    $(function() {

    });
</script>
@endsection