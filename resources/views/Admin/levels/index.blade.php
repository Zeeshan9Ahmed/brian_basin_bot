
@extends('layout.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Genere</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Generes</li>
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
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                              <label for="genere"> Genere <span class="text-danger">*</span></label>
                                        <select name="genere" id="genere" class="form-control validate[required]">
                                            
                                            @foreach($generes as $genere)
                                            <option value="{{ $genere->id }}">{{$genere->name}}</option>
                                            @endforeach
                                        </select>
                      </div>
                  </div>
                </div>
            <div class="card-body">
              <table id="category-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Level</th>
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


@endsection
@section('additional_scripts')
<script>


  $(function() {
    var num = 2
    table =  $('#category-table').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        language: {
              processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },

        ajax: {
                        url : '{!! route('admin.view.levels') !!}',
                        data: function(d){
                            d.id =   $("#genere").val();
                        }
        },
        columns: [
            { data: 'DT_RowIndex',name:"id"},
            { data: 'name', 
              render: function ( data, type, row ) {
                return data +' '+row.DT_RowIndex;
            }
            },
            { data: 'action', name: 'action' },

        ],
        "initComplete":function(e){
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
  $("#genere").change(function() {
    table.draw();
  });

</script>
@endsection
