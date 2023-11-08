@extends('layout.master')
@section('additional_styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
{{-- <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}" >--}}
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PAGE DETAIL</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Page</li>
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
                <h3 class="card-title">{{ $page->title }}</h3>
            </div>

            <!-- /.card-header -->
            <form action="{{route('admin.page.update')}}" method="POST">
                @csrf
                <div class="card-body">
                <label for="">
                    Page Title
                </label>
                <input type="text" name="title" class="form-control" value="{{ $page->title }}">
                <label for="">
                    Page Description
                </label>
                <input type="hidden" name="id" value="{{$page->id}}">
                <textarea id="summernote" name="content">
                    {{ $page->content }}
                </textarea>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </form>
            

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
  <script src="{{ asset('assets//plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    
  })
</script>

<script>


</script>
@endsection
