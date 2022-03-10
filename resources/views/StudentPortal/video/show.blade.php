@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Videos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Class</a></li>
                        <li class="breadcrumb-item active">Video</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">{{$video->name}}</h4>
                        </div>
                        <div class="card-body">
                            <?php echo"$video->embed_code" ?>
                                <h6 class="card-title"><?php echo"$video->description" ?></h6>
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
