@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Student</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Student</a></li>
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
                        <form id="myForm" action="{{route('student.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="codice_id">Codice ID :</label>
                                            <span style="color:#ff0000">*</span>
                                            <input type="text" class="form-control" name="codice_id" id="codice_id"
                                                   placeholder="Enter Codice ID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="generated_pass">Generate Password: </label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text" class="form-control" id="generated_pass"
                                                           placeholder="Generate Password">
                                                </div>
                                                <div class="col-auto">
                                                    <input type="button" class="btn btn-light" id="btn_password_gen"
                                                           value="Generate Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password :</label>
                                            <span style="color:#ff0000">*</span>
                                            <input type="password" class="form-control" name="password" id="password"
                                                   placeholder="Enter password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password :</label>
                                            <span style="color:#ff0000">*</span>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                                   placeholder="Enter password again" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email :</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                   placeholder="Enter Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Select Group :</label>
                                            <span style="color:#ff0000">*</span>
                                            <select class="selectpicker form-control" name="group_id" id="group_id" data-live-search="true" required>
                                                @foreach($groups as $group)
                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9"></div>
                                <div class="col-lg-1 col-sm-11 ">
                                    @include('components.clear_btn')
                                </div>
                                <div class="col-lg-1 col-sm-11">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .formHeader {
        background-color: #ff7700;
    }
    #password_gen{
        background-color: rgba(56,255,71,0.38);
    }
    #password_gen:hover{
        background-color: rgba(0, 150, 12, 0.38);
    }
</style>
<script>
    $( document ).ready(function() {
        $('#btn_password_gen').click('on',function(){
            var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var passwordLength = 12;
            var password = "";

            for (var i = 0; i <= passwordLength; i++) {
                var randomNumber = Math.floor(Math.random() * chars.length);
                password += chars.substring(randomNumber, randomNumber +1);
            }
            document.getElementById("generated_pass").value = password;
        })

        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    });
</script>
