@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Class</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Class</a></li>
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
                            <h3 class="card-title">Edit Class {{$class->name}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('class.update',$class->id)}}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Class Name :</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{$class->name}}" placeholder="Enter class name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="url">Class Thumbnail :</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="thumbnail" id="thumbnail">
                                                    <input type="hidden" name="current_url" value="{{$class->url}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="img">Current Class Thumbnail :</label>
                                                <img id="img" src="{{asset('/chapter_thumbnails/'.$class->url)}}" border="0" width="120" height="80" class="img-rounded" align="center">
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

                        </form>
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
