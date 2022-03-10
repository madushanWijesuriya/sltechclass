@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Announcement</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Announcement</a></li>
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
                        <form id="myForm" action="{{route('announcement.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Topic :</label>
                                            <span style="color:#ff0000">*</span>
                                            <input type="text" class="form-control" name="topic" id="topic"
                                                   value="{{$anns->topic}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Message :</label>
                                            <span style="color:#ff0000">*</span>
                                            <textarea value="{{$anns->message}}" class="form-control" rows="5" name="message"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Select Group :</label>
                                            <select class="selectpicker form-control" name="group_id[]" id="group_id" data-live-search="true" multiple>
                                                {{--                                                <option value="" selected>All Groups</option>--}}
                                                @foreach($groups as $group)
                                                    <option {{in_array($group->id,$group->->pluck('id')->toArray()) ? "selected" : ""}}
                                                            value="{{$class->id}}">{{$class->name}}</option>
                                                @endforeach
                                            </select><br>
                                            <span style="color:#6b6a6a">If you want send to all groups clear the select box</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Select Student :</label>
                                            <select class="selectpicker form-control" name="user_id[]" id="user_id" data-live-search="true" multiple>
                                                {{--                                                <option value="" selected>All Students</option>--}}
                                                @foreach($students as $student)
                                                    <option value="{{$student->id}}">{{$student->name}}</option>
                                                @endforeach
                                            </select><br>
                                            <span style="color:#6b6a6a">If you want send to all students clear the select box</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9"></div>
                                <div class="col-lg-1 col-sm-11 ">
                                    @include('components.clear_btn')
                                </div>
                                <div class="col-lg-1 col-sm-11 ">
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
