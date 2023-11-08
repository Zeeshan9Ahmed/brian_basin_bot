@extends('layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>subAdmin LIST</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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

                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                       <li class="page-item"><a href="" class="btn btn-info btn-sm margin-right" data-toggle="modal" data-target="#add-category-modal">Add New User</a></li>
                    </ul>
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="users-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    
                    <th>Action</th>
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
  <div id="up-close-modal" class="modal fade" tabindex="-1" aria-modal="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="ajaxForm" role="form" id="ur-form" action="" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group clearfix">
                        <label for="c_name"> Name <span class="text-danger">*</span></label>
                        <input type="text"  id="c_name" name="name" class="form-control validate[required]" placeholder="Enter  Name">
                    </div>
                    <div class="form-group clearfix">
                        <label for="c_name">Email <span class="text-danger">*</span></label>
                        <input type="text"  id="c_email" name="email" class="form-control validate[required]" readonly placeholder="Enter Email">
                    </div>
                    <div class="form-group clearfix">
                        <label for="c_name">Password <span class="text-danger">*</span></label>
                        <input type="text"  id="c_password" name="password" class="form-control validate[required]" placeholder="Enter Password">
                    </div>
                    <div class="form-group clearfix">
                        <input type="hidden" id="cat_id" name="id" class="form-control validate[required]" value="" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger waves-effect" id="delete-user">delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

  <div id="add-category-modal" class="modal fade" tabindex="-1" aria-modal="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="ajaxForm" role="form" id="ur-form" action="{{ route('admin.sub_admin.create') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group clearfix">
                        <label for="c_name"> Name <span class="text-danger">*</span></label>
                        <input type="text"  id="c_name" name="name" class="form-control validate[required]" placeholder="Enter  Name">
                    </div>
                    <div class="form-group clearfix">
                        <label for="c_name">Email <span class="text-danger">*</span></label>
                        <input type="text"  id="c_name" name="email" class="form-control validate[required]" placeholder="Enter Email">
                    </div>
                    <div class="form-group clearfix">
                        <label for="c_name">Password <span class="text-danger">*</span></label>
                        <input type="text"  id="c_name" name="password" class="form-control validate[required]" placeholder="Enter Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
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
        ajax: "{!! route('admin.sub_admin') !!}",
        columns: [
            { data: 'DT_RowIndex',name:"id"},
            { data: 'avatar',name:"avatar" },
            { data: 'name' },
            { data: 'email' },
            
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

    

     // update category
     $('#users-table').on('click','a.upd-category',function(e)
     {
        e.preventDefault();
        var url = $(this).attr('data-url');
        
        var id = $(this).attr('data-id');
        var formAction = '{!! route('admin.sub_admin.update') !!}';
        $.ajax({
            url: url,
            dataType: 'json',
            success: function (response, textStatus, jqXHR) {
                if(response.success == 1){
                    // console.log(response);
                    var id = response.data.id;
                    
                    $('#up-close-modal #cat_id').val(id);
                    $('#up-close-modal #c_name').val(response.data.name);
                    $('#up-close-modal #c_email').val(response.data.email);
                    $('#up-close-modal #c_password').val();
                    $('#up-close-modal form').attr("action",formAction);
                    
                    
                    $("#up-close-modal").modal('show');

                }else{
                    toastr.error(response.message,'error');
                }

            }
        });
    })

    $(document).on('click','#delete-user',function(e)
     {
        e.preventDefault();
        id = $('#cat_id').val()
        var url = "{{ route('admin.sub_admin.delete', ':id') }}";
	    url = url.replace(':id', id);
        $.ajax({
            url: url,
            dataType: 'json',
            success: function (response, textStatus, jqXHR) {
                if(response.success == 1){
                    
                    toastr.success(response.message,'success');
                    window.location.reload();

                    $("#up-close-modal").hide('show');
                    
                }else{
                    toastr.error(response.message,'error');
                }

            }
        });
    })

});
</script>
<script>


</script>
@endsection
