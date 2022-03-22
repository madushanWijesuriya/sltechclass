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
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <bWr>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-3 text-center">
                        <figure class="figure">
                            <a href="{{route('student-class.index')}}">
                                <div class="dash" style="background-color: white; width: 200px; height: 100px">
                                    <img width="100px" height="80px"
                                         src="{{asset('/dashboard/4.png')}}"
                                         loading="lazy" style="margin-top: 7px">

                                    {{--                        <a href="{{route('class.payNow',$class->id)}}" class="btn-success btn-sm">Pay--}}

                                </div>
                            </a>
                            <div class="row">
                                <div class="col">
                                    <figcaption
                                        class="figure-caption text-center">My Class
                                    </figcaption>
                                </div>
                            </div>
                            <br>
                        </figure>
                        <figure class="figure">
                            <a href="{{route('user.index')}}">
                                <div  class="dash" style="background-color: white;width: 200px; height: 100px">
                                    <img width="100px" height="80px"
                                         src="{{asset('/dashboard/2.png')}}"
                                         loading="lazy" style="margin-top: 15px">

                                    {{--                        <a href="{{route('class.payNow',$class->id)}}" class="btn-success btn-sm">Pay--}}

                                </div>
                            </a>
                            <div class="row">
                                <div class="col">
                                    <figcaption
                                        class="figure-caption text-center">Pay Now
                                    </figcaption>
                                </div>
                            </div>
                            <br>
                        </figure>
                        <figure class="figure">
                            <a href="{{route('class.delayPayment')}}">
                                <div class="dash" style="background-color: white;width: 200px; height: 100px;width: 200px; height: 100px">
                                    <img width="100px" height="80px"
                                         src="{{asset('/dashboard/3.png')}}"
                                         loading="lazy" style="margin-top: 7px ">

                                    {{--                        <a href="{{route('class.payNow',$class->id)}}" class="btn-success btn-sm">Pay--}}

                                </div>
                            </a>
                            <div class="row">
                                <div class="col">
                                    <figcaption
                                        class="figure-caption text-center">Delayed Payment
                                    </figcaption>
                                </div>
                            </div>
                            <br>
                        </figure>
                        <figure class="figure">
                            <a href="{{route('announcementStudent.index')}}">
                                <div class="dash" style="background-color: white;width: 200px; height: 100px;">
                                    <img width="100px" height="80px"
                                         src="{{asset('/dashboard/1.png')}}"
                                         loading="lazy" style="margin-top: 7px">

                                    {{--                        <a href="{{route('class.payNow',$class->id)}}" class="btn-success btn-sm">Pay--}}

                                </div>
                            </a>
                            <div class="row">
                                <div class="col">
                                    <figcaption
                                        class="figure-caption text-center">Announcement
                                    </figcaption>
                                </div>
                            </div>
                            <br>
                        </figure>
                    </div>
                </div>
        </div>
    </section>
@endsection
<style>
    .formHeader {
        background-color: #ff7700;
    }

    .dash {
        border: 1px solid #ff7700;
    }
</style>
