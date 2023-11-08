@extends('layout.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SEND NOTIFICATION</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Notifications</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
   
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detail</h3>
                    </div>
                    <form class="ajaxForm" role="form" id="ur-form" action="{{route('admin.save.notification')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        <div class="card-body append">
                                    <div class="card-body">
                                        <div class="row mt-1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="title">Title<span class="text-danger">*</span></label>
                                                    <input type="text" id="title" name="title" class="form-control validate[required,minSize[3]]"  placeholder="" >
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-0">
                                                <div class="form-group">
                                                    <label for="description"> Description<span class="text-danger">*</span></label>    
                                                    <div>
                                                        <textarea name="description" rows="15" class="form-control validate[required,,minSize[6]]"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                              
                            <button type="submit" class="btn btn-info" id="add-more">Send </button>
                            
                                               

                        </div>

                        
                        
                    </form>
                </div>
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
  
</script>
<script>


</script>
@endsection
