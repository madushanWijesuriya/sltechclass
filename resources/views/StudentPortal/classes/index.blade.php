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
                    @foreach($classes as $index => $class)
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            @if($index === 0)
                                <div class="small-box bg-info">
                                    @elseif($index === 1)
                                        <div class="small-box bg-success">
                                            @elseif($index === 2)
                                                <div class="small-box bg-danger">
                                                    @endif
                                                    <div class="inner">
                                                        <h3>Name - {{$class->name}}</h3>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-bag"></i>
                                                    </div>
                                                    <a href="{{route('student-class.show',$class->id)}}"
                                                       class="small-box-footer">Go Class<i
                                                            class="fas fa-arrow-circle-right"></i></a>
                                                </div>
                                        </div>
                                        @endforeach
                                    @else
                                    @endif

                                </div>
                        </div>
    </section>
@endsection
<style>
    .formHeader {
        background-color: #ff7700;
    }
</style>
