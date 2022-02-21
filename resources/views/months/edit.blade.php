@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Month</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Month</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-orange">
                        <div class="card-header">
                            <h3 class="card-title">Edit Month</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="myForm" action="{{route('month.update',$month->id)}}}}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
{{--                            <div class="form-group">--}}
{{--                                <input type="hidden" class="form-control" name="class_id" id="class_id" value="{{$id}}" required>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="col">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Month Name :</label>
                                            <span style="color:#ff0000">*</span>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   value="{{$month->name}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Month Fee :</label>
                                            <span style="color:#ff0000">*</span>
                                            <input type="number" class="form-control" name="fee" id="fee"
                                                   value="{{$month->fee}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Current Month Period:</label>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="start">Start Date:</label>
                                                    <input type="text" class="form-control float-right" id="start"  value="{{$month->start_at}}" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="end">End Date:</label>
                                                    <input type="text" class="form-control float-right" id="end"  value="{{$month->end_at}}" readonly>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label>Edit Month Period:</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control float-right" id="reservation" name="period">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1 offset-9">
                                    @include('components.clear_btn')
                                </div>
                                <div class="col-1">
                                    @include('components.primary_btn')
                                </div>
                            </div>

                            <!-- /.card-body -->

                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<style>
    .formHeader {
        background-color: #ff7700;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        //Date range picker
        $('#reservation').daterangepicker()

        document.getElementById("myForm").reset();
    });

</script>
