@extends('layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>JOB LIST</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Jobs</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">DETAILS</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="jobs-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Job Title</th>
                    <th>Category</th>
                    <th>Created By</th>
                    <th>Assigned To</th>
                    <th>Created On</th>
                    <th>Status</th>
                    <th>View</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
  @section('additional_scripts')
<script>
  $(function() {
    table =  $('#jobs-table').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        pagingType:"simple",
        language: {
              processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
        ajax: "{!! route('admin.jobs') !!}",
        columns: [
            { data: 'DT_RowIndex',name:"jobs.id"},
            { data: 'name',name:"name" },
            { data: 'category.name',name:"category.name" },
            { data: 'posted_by.full_name', name:"posted_by.full_name" },
            { data: 'hired_jobs[0].user.full_name',
              render: function ( data, type, row ) {
                if(data){
                  return data;
                }else{
                  return 'N/A';
                }
               
            }
            },
            { data: 'created_at' },
            { data: 'status', name: 'status',
              render: function ( data, type, row ) {
                if(data){
                  return data;
                }else{
                  return '<span class="badge badge-danger">Not Hired<span>';
                  
                  // return 'Not Hired';
                }
               
            }
            
            },
            
            { data: 'action', name: 'action' },
            

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


</script>
@endsection
