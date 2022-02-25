@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Class</h1>
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
                            <h3 class="card-title">Add new</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('class.storeClassSetting')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Select Group :</label>
                                            <select class="selectpicker form-control" name="group_id[]" id="group_id"
                                                    data-live-search="true">
                                                @foreach($groups as $group)
                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Select Month :</label>
                                            <select class="selectpicker form-control" name="month_id[]" id="month_id"
                                                    data-live-search="true" multiple>
                                                @foreach($months as $month)
                                                    <option value="{{$month->id}}">{{$month->name}}
                                                        ({{$month->classe->name}})
                                                    </option>
                                                @endforeach
                                            </select>
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
                        <br>
                        @include('class.setting.table')
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
    $(function () {
        var group_id = $('#group_id').val();

        $("select").on("changed.bs.select",
            function (e, clickedIndex, newValue, oldValue) {
                $.ajax({
                    type: "get",
                    url: "{{ route('group.getMonthByGroup')}}",
                    data: {
                        group_id: clickedIndex,
                    },
                    success: function (rooms) {

                    }

                });
            });
    });

</script>
