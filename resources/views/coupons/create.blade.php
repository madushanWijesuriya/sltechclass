@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Coupon</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Coupon</a></li>
                        <li class="breadcrumb-item active">create</li>
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
                            <h3 class="card-title">Add new</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="myForm" action="{{route('coupon.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">coupon code :</label>
                                            <span style="color:#ff0000">*</span>
                                            <input type="text" class="form-control" name="code" id="code"
                                                   placeholder="Enter coupon code" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Percentage (%) :</label>
                                            <span style="color:#ff0000">*</span>
                                            <input type="text" class="form-control" name="percentage" id="percentage"
                                                   placeholder="Enter percentage" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Month Period:</label>
                                            <span style="color:#ff0000">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control float-right" id="reservation" name="period" required>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Select Student :</label>
                                            <span style="color:#ff0000">*</span>
                                            <select class="selectpicker form-control" name="user_id" id="user_id" data-live-search="true" required>
                                                @foreach($students as $student)
                                                    <option value="{{$student->id}}">{{$student->name}}</option>
                                                @endforeach
                                            </select>
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
