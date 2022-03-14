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
                        <form id="myForm" action="{{route('class.giveAccess')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Select Group :</label>
                                            <select class="selectpicker form-control" name="group_id[]" id="group_id"
                                                    data-live-search="true" required>
                                                @foreach($groups as $group)
                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Select Month :</label>
                                            <select class="selectpicker form-control" name="month_id[]" id="month_id"
                                                    data-live-search="true" multiple required>
                                                @foreach($months as $month)
                                                    @if($month->classe->group_id !== null)
                                                    <option value="{{$month->id}}">{{$month->name}}
                                                        ({{$month->classe->name}}
                                                        )({{\App\Models\Group::find($month->classe->group_id)->name}})
                                                    </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-sm-12 col-md-6"></div>
                                <div class="col-lg-2 col-sm-12 col-md-3">
                                    @include('components.primary_btn',['name'=>"Give Access", 'id' => "submit" , 'type'=>'button'])
                                </div>
                                <div class="col-lg-1 col-sm-12 col-md-3">
                                    @include('components.primary_btn',['name'=>"Block",'id' => "block",'class_name'=>"btn btn-flat btn-danger primary_btn float-right",'type'=>'button'])
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
        {{--var group_id = $('#group_id').val();--}}

        // $("select").on("changed.bs.select",
        //     function (e, clickedIndex, newValue, oldValue) {
        //
        //
        //         });
        //     });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#submit').on('click', function () {
            var ajax = true;
            if ($('#group_id').val() === null) {
                toastr.error('Group is Required');
                ajax = false;
            } else if ($('#month_id').val().length < 1) {
                toastr.error('Month is Required');
                ajax = false;
            }
            if (ajax){
                var rows = document.getElementsByTagName("tbody")[0].rows;
                var ids = [];
                for (var i = 0; i < rows.length; i++) {
                    if (rows[i].getElementsByTagName("td")[0].getElementsByTagName('input')[0].checked) {
                        ids.push(rows[i].getElementsByTagName("td")[1].innerHTML)

                    }
                }
                $.ajax({
                    type: "post",
                    url: "{{ route('class.giveAccess')}}",
                    data: {
                        group_id: $('#group_id').val(),
                        month_id: $('#month_id').val(),
                        user_id: ids,
                    },
                    success: function (res, code) {
                        if (res.code === 200) {
                            toastr.success(res.status);
                            location.reload();
                        } else {
                            toastr.error(res.status);
                        }
                    },
                    error: function (res) {
                        toastr.error(res.statusText);
                    }
                })
            }

        })

        $('#block').on('click', function () {
            var ajax = true;
            if ($('#group_id').val() === null) {
                toastr.error('Group is Required');
                ajax = false;
            } else if ($('#month_id').val().length < 1) {
                toastr.error('Month is Required');
                ajax = false;
            }

            var rows = document.getElementsByTagName("tbody")[0].rows;
            var ids = [];
            for (var i = 0; i < rows.length; i++) {
                if (rows[i].getElementsByTagName("td")[0].getElementsByTagName('input')[0].checked) {
                    ids.push(rows[i].getElementsByTagName("td")[1].innerHTML)

                }
            }
            $.ajax({
                type: "post",
                url: "{{ route('class.blockAccess')}}",
                data: {
                    group_id: $('#group_id').val(),
                    month_id: $('#month_id').val(),
                    user_id: ids,
                },
                success: function (res, code) {
                    if (res.code === 200) {
                        toastr.success(res.status);
                        location.reload();
                    } else {
                        toastr.error(res.status);
                    }
                },
                error: function (res) {
                    toastr.error(res.statusText);
                }
            })
        })
    });

</script>
