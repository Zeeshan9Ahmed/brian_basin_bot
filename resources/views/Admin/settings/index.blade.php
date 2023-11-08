@extends('layout.master')
@section('additional_styles')
    <!-- bootstrap slider -->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/bootstrap-slider/css/bootstrap-slider.min.css') }}">
    <!-- Ion Slider -->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css') }} ">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>SETTINGS</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        @include('Admin.settings.profile-section')
                        
                    </div>
                    <div class="col-md-6 col-sm-12">
                        @include('Admin.settings.password-section')
                    </div>
                    <!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('additional_scripts')
<!-- Bootstrap slider -->
<script src="{{ asset('public/assets/plugins/bootstrap-slider/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<script>
    $("document").ready(function(e){
        /* BOOTSTRAP SLIDER */
        $('.slider').bootstrapSlider();
        /* ION SLIDER */
        /* ION SLIDER */
        
    })
</script>
@endsection