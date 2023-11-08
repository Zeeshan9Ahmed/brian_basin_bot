@extends('layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Technician Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Technician</a></li>
                        <li class="breadcrumb-item active">Technician Profile</li>
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
                                <?php if ($technician->avatar != "") { ?>
                                    <img class="profile-user-img img-fluid img-circle" style="width:128px;height:128px;" src="{{ getThumbnailUrl($technician->avatar) }}" title="{{ $technician->full_name }}" alt="Profile Image">
                                <?php } else { ?>
                                    <img class="profile-user-img img-fluid img-circle" style="width:128px;height:128px;" src="{{ asset('assets/avatar.png') }}" title="{{ $technician->full_name }}" alt="Profile Image">
                                <?php } ?>
                            </div>
                            <h3 class="profile-username text-center">{{ $technician->full_name }}</h3>
                            <p class="text-muted text-center">Technician</p>


                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Expert In</b>
                                    @foreach ($technician->expertises as $expertise )
                                    <a class="float-right"> {{ $expertise['name'] }}</a>
                                    <br />
                                    @endforeach

                                </li>
                                <li class="list-group-item">
                                    <b>Phone</b><a class="float-right"> {{ $technician->phone_number }}</a>
                                </li>

                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right"><?php echo ($technician->is_active == 1 ? "<label class='badge badge-success'>ACTIVE</label>" : "<label class='badge badge-danger'>DEACTIVE</label>"); ?></a>
                                </li>
                            </ul>
                            <?php $lock = ($technician->is_active == 1 ? "fas fa-lock-open" : "fas fa-lock"); ?>
                            <a href="{{ url('admin/technician/status/'.$technician->id) }}" class="btn btn-block {{ $technician->is_active==1?"btn-primary":"btn-danger" }} ajax" title="Change Status"><b> {{ $technician->is_active==0?"Click to Activate":"Click to Deactivate" }} <i class="{{ $lock }}"></i></b></a>

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->

                </div>

                <div class="col-12 col-sm-12 col-md-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12 col-sm-6 col-lg-12">
                                <div class="card-tabs">
                                    <div class="p-0 pt-1 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                            <li class="nav-item lli-custom">
                                                <a class="nav-link tab-custom active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><i class="" style="font-size: 22px;"></i> &nbsp;Completed Jobs</a>
                                            </li>
                                            <li class="nav-item lli-custom">
                                                <a class="nav-link tab-custom" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><i class="" style="font-size: 22px;"></i> &nbsp;Hired Jobs</a>
                                            </li>
                                            <li class="nav-item lli-custom">
                                                <a class="nav-link tab-custom" id="job-requests-tab" data-toggle="pill" href="#job-requests" role="tab" aria-controls="job-requests" aria-selected="false"><i style="font-size: 22px;"></i> &nbsp;Job Requests</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body" style="padding:0;padding-top:20px">
                                        <div class="tab-content" id="custom-tabs-two-tabContent">
                                            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                <!-- DRIVER CONTENT START-->
                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Completed Jobs</h3>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <table id="users-table" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>SN</th>
                                                                    <th>Job Title</th>
                                                                    <th>Category</th>
                                                                    <th>Created By</th>
                                                                    <th>Created On</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.DRIVER CONTENT END -->
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                                <!-- ROUTE CONTENT START-->
                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Hired Jobs</h3>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <table id="hired-jobs" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                    <th>SN</th>
                                                                    <th>Job Title</th>
                                                                    <th>Category</th>
                                                                    <th>Created By</th>
                                                                    <th>Hired On</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- ROUTE CONTENT END-->
                                            </div>

                                            <div class="tab-pane fade" id="job-requests" role="tabpanel" aria-labelledby="job-requests-tab">
                                                <!-- ROUTE CONTENT START-->
                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Job Requests</h3>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <table id="requested-jobs" class="table table-bordered table-striped">
                                                            <thead>
                                                            <tr>
                                                                    <th>SN</th>
                                                                    <th>Job Title</th>
                                                                    <th>Category</th>
                                                                    <th>Created By</th>
                                                                    <th>Hired On</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- ROUTE CONTENT END-->
                                            </div>


                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
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
    $(function() {
        $(document).on('click', '#custom-tabs-two-profile-tab', function() {
            hiredJobsDataTable();
        });
        $(document).on('click', '#custom-tabs-two-home-tab', function() {
            completedJobsDataTable();
        });

        $(document).on('click', '#job-requests-tab', function() {
            requestedJobsDataTable()
        });


        completedJobsDataTable();

        function completedJobsDataTable() {
            if (!$.fn.dataTable.isDataTable('#users-table')) {
                $('#users-table').DataTable({
                    dom: 'Bfrtip',
                    processing: true,
                    serverSide: true,
                   ajax: "{{ route('technician.jobs.completed', $technician->id ) }}",
                    columns: [
                        { data: 'DT_RowIndex',name:"id"},
                        { data: 'job_title[0].name',name:"job_title[0][name]" },
                        { data: 'job_title[0].category.name',name:"job_title[0].category[0].name"},
                        { data: 'job_title[0].posted_by.full_name',name:"job_title[0].posted_by[0].full_name"},
                        { data: 'job_title[0].created_at',name:"job_title[0][name]" },
                        { data: 'action', name: 'action' },
                    ],
                    
                    
                });
            }
        }

        function hiredJobsDataTable() {
            if (!$.fn.dataTable.isDataTable('#hired-jobs')) {
                $('#hired-jobs').DataTable({
                    dom: 'Bfrtip',
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('technician.jobs.hired', $technician->id ) }}",
                    columns: [
                        { data: 'DT_RowIndex',name:"id"},
                        { data: 'job_title[0].name',name:"job_title[0][name]" },
                        { data: 'job_title[0].category.name',name:"job_title[0].category[0].name"},
                        { data: 'job_title[0].posted_by.full_name',name:"job_title[0].posted_by[0].full_name"},
                        { data: 'job_title[0].created_at',name:"job_title[0][name]" },
                        { data: 'action', name: 'action' },
                    ],
                });
            }
        }

        function requestedJobsDataTable() {
            if (!$.fn.dataTable.isDataTable('#requested-jobs')) {
                $('#requested-jobs').DataTable({
                    dom: 'Bfrtip',
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('technician.jobs.requested', $technician->id ) }}",
                    columns: [
                        { data: 'DT_RowIndex',name:"id"},
                        { data: 'job_title[0].name',name:"job_title[0][name]" },
                        { data: 'job_title[0].category.name',name:"job_title[0].category[0].name"},
                        { data: 'job_title[0].posted_by.full_name',name:"job_title[0].posted_by[0].full_name"},
                        { data: 'job_title[0].created_at',name:"job_title[0][name]" },
                        { data: 'action', name: 'action' },
                    ],
                });
            }
        }

     
    });
</script>
<script>
    $(function() {

    });
    $(function() {

    });
</script>
@endsection