@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{--                    <h1>My Class</h1>--}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Class</a></li>
                        <li class="breadcrumb-item active">My</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 text-center">
                    <div style="background-color: #007bff">My Class</div>
                </div>
                <div class="col-lg-3"></div>
            </div>
            <br>
            <br>
            <div class="row">
                @if($classes)
                    @foreach($classes as $class)
                        @if(count($classes) === 1)
                            <div class="col-lg-12 col-sm-12 col-md-12 text-center">
                                @elseif(count($classes) === 2)
                                    <div class="col-lg-6 col-sm-6 col-md-6 text-center">
                                        @endif


                                        <figure class="figure">
                                            <img width="200px" height="100px"
                                                 src="{{asset('/class_thumbnails/'.$class->url)}}"
                                                 loading="lazy">
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <figcaption
                                                        class="figure-caption text-center">{{$class->name}}</figcaption>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <a href="{{route('class.payNow',$class->id)}}" class="btn-success btn-sm">Pay
                                                Now</a>
                                        </figure>
                                    </div>
                                    @endforeach
                                @else
                                @endif

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
