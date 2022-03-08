@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Class</h1>
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
                @if($classes)
                    @foreach($classes as $class)
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <a href="{{route('student-class.show',$class->id)}}">
                                <figure class="figure">
                                    <img width="200px" height="100px" src="{{asset('/class_thumbnails/'.$class->url)}}" loading="lazy">
                                    <div class="row">
                                        <div class="col">
                                            <figcaption class="figure-caption text-center">{{$class->name}}</figcaption>
                                        </div>
                                    </div>
                                </figure>
                            </a>
                        </div>
                    @endforeach
                @else
                @endif
            </div>
        </div>
    </section>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payments</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('StudentPortal.payments.delay.table')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payments History</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('StudentPortal.payments.history.dashboard_table')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Announcement</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('StudentPortal.Announcement.dashboard_table')
@endsection
<style>
    .formHeader {
        background-color: #ff7700;
    }
</style>
