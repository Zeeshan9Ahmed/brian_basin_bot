@extends('layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Job Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Job</a></li>
                        <li class="breadcrumb-item active">Job List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="row">
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-md-3">
               <!-- Profile Image -->
               <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                  <div class="text-center">
                                <?php if ($job->load('postedBy')->postedBy->avatar != "") { 
                                    dd();
                                    ?>
                                    <img class="profile-user-img img-fluid img-circle" style="width:128px;height:128px;" src="{{ getThumbnailUrl($job->postedBy->avatar) }}" title="{{ $job->postedBy->full_name }}" alt="Profile Image">
                                <?php } else { ?>
                                    <img class="profile-user-img img-fluid img-circle" style="width:128px;height:128px;" src="{{ asset('assets/avatar.png') }}" title="{{ $job->postedBy->full_name }}" alt="Profile Image">
                                <?php } 
                                ?>
                            </div>

                            <h3 class="profile-username text-center">{{ $job->postedBy->full_name }}</h3>
                            <p class="text-muted text-center">Job Created By</p>
                                    
                     <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                           <b>Phone </b> <a class="float-right"> {{ $job->postedBy->phone_number }} </a>
                        </li>
                        
                     </ul>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
            <!-- /.col -->
            
            <div class="col-12 col-sm-12 col-md-9">
               <div class="row">
                  <div class="col-12">
                     <div class="card card-primary">
                        <div class="card-header">
                           <h3 class="card-title">DETAILS</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <div class="row pb-4">
                              <div class="col-4">
                                 <h5>Job Name</h5>
                                 <span class="text-center data-color">{{$job->name}} </span>
                              </div>
                              
                              <div class="col-4">
                                 <h5>Job Category</h5>
                                 <span class="text-center data-color">{{$job->load('category')->category->name}} </span>
                              </div>
                              
                              <div class="col-4">
                                 <h5>Location</h5>
                                 <span class="text-center data-color">{{$job->location}} </span>
                              </div>
                           </div>
                           <!--/row-->
                           <div class="row pb-4">
                              <div class="col-4">
                                 <h5>Date</h5>
                                 <span class="badge 12-bg text-center">{{ $job->date}}  </span>
                              </div>
                              <div class="col-4">
                                 <h5>Time</h5>
                                 <span class="text-center data-color">{{$job->time}}</span>
                              </div>
                              
                              <div class="col-4">
                                 <h5>Job Status</h5>
                                 <span class="text-center data-color">
                                 
                                 @if ( ($job->load('hiredJobs')->toArray()) )
                                 @if (empty($job->hiredJobs->toArray()))
                                 Not Hired       
                                @endif
                                 
                                 @foreach ($job->hiredJobs as $status )
                                    
                                    @if ($status->is_hired == 1 && $status->is_completed ==1)
                                    Completed 
                                    @elseif ($status->is_hired == 1 && $status->is_completed ==0)
                                        Hired
                                    @else
                                    Not Hired
                                    @endif
                                 @endforeach    
                                    @else
                                    
                                 @endif
                                 
                                 </span>
                              </div>
                              
                           </div>
                           <!--/row-->
                           <div class="row pb-4">
                              <div class="col-4">
                                 <h5>Assigned To</h5>
                                 <span class="text-center data-color">
                                 @if (count ($job->hiredJobs) >0)    
                                 {{$job->hiredJobs[0]->load(['user'])->user->full_name }}
                                @else
                                N/A
                                @endif
                                </span>
                              </div>
                              
                              <div class="col-4">
                                 <h5>Job Description</h5>
                                 <span class="text-center data-color">{{$job->details}}</span>
                              </div>
                              <div class="col-4">
                                
                              </div>
                           </div>
                           <!--/row-->
                           
                           <!--/row-->
                           
                           <!--/row-->
                        </div>
                        <!-- /.card-body -->
                     </div>
                     <!-- /.card -->
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </div>
            <!-- /.col -->
                        
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Job Proposals</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="users-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Avatar</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        

         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
    <!-- /.content -->
</div>
@endsection

@section('additional_scripts')

<script>
  $(function() {
    table =  $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        pagingType:"simple",
        language: {
              processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
        ajax: "{!! route('admin.single.job', $job->id) !!}",
        columns: [
            { data: 'DT_RowIndex',name:"id"},
            { data: 'avatar',name:"avatar" },
            { data: 'user.full_name' },
            { data: 'user.phone_number' },
            { data: 'status' },
            
            

        ],
        initComplete: function()
        {
         $(".dataTables_filter input")
          .unbind() // Unbind previous default bindings
          .bind("keyup", function(event) { // Bind our desired behavior
              // If the length is 3 or more characters, or the user pressed ENTER, search
              if(event.keyCode == 13) {
                  // Call the API search function
                  table.search(this.value).draw();
              }
              // Ensure we clear the search if they backspace far enough
              if(this.value == "") {
                table.search("").draw();
              }
              return;
          });
        }
    });

});
</script>
<script>
    $(function() {

    });
    $(function() {

    });
</script>
@endsection