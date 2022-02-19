@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Video</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Video</a></li>
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
                        <form action="{{route('video.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="month_id" id="month_id" value="{{$id}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Video Name :</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter video name" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Video  Description</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="5" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Video Embed Code</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="5" name="embed_code" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    @include('components.primary_btn')
                                </div>
                            </div>

                            <!-- /.card-body -->

                        </form><br>

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
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('description');
    })
</script>
