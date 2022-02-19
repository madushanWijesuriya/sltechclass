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
                                                <img id="img" src="{{asset('/class_thumbnails/'.$class->url)}}" border="0" width="120" height="80" class="img-rounded" align="center">
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
                    <div class="card card-white">
                        <div class="row">
                            <div class="col">
                                <a href="{{route('month.createMonth',['id'=>$class->id])}}" class="btn btn-flat primary_btn float-left navbar-orange">Add New Month</a>
                                <style>
                                    .primary_btn:hover{
                                        background-color: #007bff;
                                    }

                                </style>
                            </div>
                        </div>
                        <br>
                        <div class="container">
                            <div id="accordion">
                                @foreach ($months as $index => $month)
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 ">
                                            <h5 class="mb-0">
                                                <button id="btn{{$index}}"  class="btn btn-flat collapsed btncollaps" data-toggle="collapse" data-target="#collapse{{$index}}"
                                                        aria-expanded="false" aria-controls="collapse{{$index}}" style="background-color:transparent">
                                                    <h3 align="left">{{$month->name}} - Month<i class="fa fa-caret-down" aria-hidden="true" style="color: black"></i></h3>
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="col-lg-3 col-sm-12 col-md-12 ">
                                            @include('components.action_btn',['name'=> 'Edit','route'=>route('month.edit',$month->id),'class'=>'btn btn-block btn-sm btn-outline-success'])
                                        </div>
                                        <div class="col-lg-3 col-sm-12 col-md-12 ">
                                            @include('components.action_btn',['name'=> 'Delete','route'=>route('month.destroy',$month->id),'class'=>'btn btn-block btn-sm btn-outline-danger'])
                                        </div>
                                        <div class="col-lg-3 col-sm-12 col-md-12 ">
                                            @include('components.action_btn',['name'=> 'Add Video','route'=>route('video.create',$month->id),'class'=>'btn btn-block btn-sm btn-outline-primary'])
                                        </div>
                                        <div class="col-lg-3 col-sm-12 col-md-12 ">
                                            @include('components.action_btn',['name'=> 'Add Quiz','route'=>route('quiz.create',$month->id),'class'=>'btn btn-block btn-sm btn-outline-primary'])
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="collapse{{$index}}" class="collapse" aria-labelledby="heading{{$index}}" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div id="accordion_video">
                                                    <div class="row">
                                                        <div class="col-lg-11 col-sm-11 col-md-11">
                                                            <h5 class="mb-0">
                                                                <button id="btn{{$index}}"  class="btn btn-xs btn-flat collapsed btncollaps" data-toggle="collapse" data-target="#video{{$index}}"
                                                                        aria-expanded="false" aria-controls="video{{$index}}" style="background-color:transparent">
                                                                    <h5 align="left">{{$month->name}} - Video<i class="fa fa-caret-down" aria-hidden="true" style="color: black"></i></h5>
                                                                </button>
                                                            </h5>

                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div id="video{{$index}}" class="collapse" aria-labelledby="heading{{$index}}" data-parent="#accordion_video">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-6">
                                                                    <h6>ssssssssssss</h6>
                                                                </div>
                                                                <div class="col-lg-2 col-sm-12 col-md-3 ">
                                                                    @include('components.action_btn',['name'=> 'Edit','route'=>route('video.edit',$month->id),'class'=>'btn btn-block btn-sm btn-outline-success'])
                                                                </div>
                                                                <div class="col-lg-2 col-sm-12 col-md-3 ">
                                                                    @include('components.action_btn',['name'=> 'Delete','route'=>route('video.destroy',$month->id),'class'=>'btn btn-block btn-sm btn-outline-danger'])
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="accordion_quiz">
                                                    <div class="row">
                                                        <div class="col-lg-11 col-sm-11 col-md-11">
                                                            <h5 class="mb-0">
                                                                <button id="btn{{$index}}"  class="btn btn-xs btn-flat collapsed btncollaps" data-toggle="collapse" data-target="#quiz{{$index}}"
                                                                        aria-expanded="false" aria-controls="quiz{{$index}}" style="background-color:transparent">
                                                                    <h5 align="left">{{$month->name}} - Quiz<i class="fa fa-caret-down" aria-hidden="true" style="color: black"></i></h5>
                                                                </button>
                                                            </h5>

                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <div id="quiz{{$index}}" class="collapse" aria-labelledby="heading{{$index}}" data-parent="#accordion_quiz">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-8 col-sm-12 col-md-6">
                                                                    <h6>ssssssssssss</h6>
                                                                </div>
                                                                <div class="col-lg-2 col-sm-12 col-md-3 ">
                                                                    @include('components.action_btn',['name'=> 'Edit','route'=>route('quiz.edit',$month->id),'class'=>'btn btn-block btn-sm btn-outline-success'])
                                                                </div>
                                                                <div class="col-lg-2 col-sm-12 col-md-3 ">
                                                                    @include('components.action_btn',['name'=> 'Delete','route'=>route('quiz.destroy',$month->id),'class'=>'btn btn-block btn-sm btn-outline-danger'])
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

{{--                                                @foreach ($chapter['videos'] as $item)--}}
{{--                                                    @if($counter ==5)--}}
{{--                                                        <div class="col-lg-2 col-sm-6 col-md-6" id="chapterCol" style="max-width: 50%">--}}
{{--                                                            <a href="{{url('chapter/videos/'.$chapter['id'])}}">--}}
{{--                                                                <div class="single-team">--}}
{{--                                                                    <div class="team-img">--}}
{{--                                                                        <img src="{{asset('public/thumbnails/'.$item->thumbnail)}}" loading="lazy">--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="team-content">--}}
{{--                                                                        <h3>See more</h3>--}}
{{--                                                                    </div>--}}
{{--                                                                    <h3><br><br></h3>--}}
{{--                                                                </div>--}}
{{--                                                            </a>--}}
{{--                                                        </div>--}}
{{--                                                        @break;--}}
{{--                                                    @else--}}
{{--                                                        <div class="col-lg-2 col-sm-6 col-md-6" id="chapterCol" style="max-width: 50%">--}}
{{--                                                            <a href="{{url('single-video/'.$item->id)}}">--}}
{{--                                                                <div class="single-team">--}}
{{--                                                                    <div class="team-img">--}}
{{--                                                                        <img src="{{asset('public/thumbnails/'.$item->thumbnail)}}" loading="lazy">--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="team-content">--}}
{{--                                                                        <h3>{{$item->video_title}}</h3>--}}
{{--                                                                    </div>--}}
{{--                                                                    <h3><br><br></h3>--}}
{{--                                                                </div>--}}
{{--                                                            </a>--}}
{{--                                                        </div>--}}
{{--                                                    @endif--}}


{{--                                                    @php--}}
{{--                                                        $counter++;--}}
{{--                                                    @endphp--}}
{{--                                                @endforeach--}}
                                            </div>

                                        </div>
                                    </div>

                                @endforeach
                            </div>
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
    $(document).ready(function () {
        $(".btncollaps").click('on',function() {
            $('#collapseParent').focus()
            $('.btncollaps').find('i').addClass("fa-caret-down").removeClass("fa-caret-up");
            var value = $(this).attr('aria-expanded');
            if (value === 'true'){
                console.log(value)
                $(this).find('i').addClass("fa-caret-down").removeClass("fa-caret-up");
            }else if (value === 'false') {
                console.log(value)
                $(this).find('i').addClass("fa-caret-up").removeClass("fa-caret-down");
            }
        });
    });
</script>
