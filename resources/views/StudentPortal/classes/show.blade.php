@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$class->name}} Class</h1>
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
                            <h3 class="card-title">Videos</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                    </div>
                    <div class="card card-white">
                        <div class="container">
                            @if($months)
                                <div class="row">
                                    @foreach($videos as $video)
                                        <div class="col-lg-3 col-sm-6 col-md-6">
                                            <a href="{{route('student-class.video.play',['month_id'=>$video->month->id,'video_id'=>$video->id])}}">
                                                <figure class="figure">
                                                    <img width="200px" height="100px" src="{{asset('/video_thumbnails/'.$video->url)}}" loading="lazy">
                                                    <div class="row">
                                                        <div class="col">
                                                            <figcaption class="figure-caption text-center">{{$video->name}}</figcaption>
                                                        </div>
                                                    </div>
                                                </figure>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-orange">
                        <div class="card-header">
                            <h3 class="card-title">Quizzes</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                    </div>
                    <div class="card card-white">
                        <div class="container">
                            @if($months)
                                <div class="row">
                                    @foreach($quizes as $quiz)
                                        <div class="col-lg-3 col-sm-6 col-md-6">
                                            <a href="{{route('student-class.quiz.play',['month_id'=>$quiz->month->id,'quiz_id'=>$quiz->id])}}">
                                                <figure class="figure">
                                                    <img width="200px" height="100px" src="{{asset('/quiz_thumbnails/'.$quiz->url)}}" loading="lazy">
                                                    <div class="row">
                                                        <div class="col">
                                                            <figcaption class="figure-caption text-center">{{$quiz->name}}</figcaption>
                                                        </div>
                                                    </div>
                                                </figure>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                            @endif
                        </div>
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

</script>
