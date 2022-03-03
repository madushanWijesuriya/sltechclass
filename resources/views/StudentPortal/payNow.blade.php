@extends('layouts.app')
@section('custom_css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
@endsection
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
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">All Months</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="filter-container p-0 row">
                                    @if(count($months) < 1)
                                        <h1>There is no any months</h1>
                                    @endif
                                    @foreach($months as $month)
                                        <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                            <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1"
                                               data-toggle="lightbox" data-title="sample 1 - white">
                                                <img src="https://via.placeholder.com/300/FFFFFF?text=1"
                                                     class="img-fluid mb-2" alt="white sample"/>
                                            </a>
                                            <h4>{{$month->isPaid() ? "Paid" : "Unpaid"}}</h4>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

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
                            <h3 class="card-title">Make a Payment</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('class.checkout')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Select Months :</label>
                                            <span style="color:#ff0000">*</span>
                                            <select class="selectpicker form-control" name="month_id[]" id="month_id"
                                                    data-live-search="true" multiple required>
                                                @foreach($months as $month)
                                                    <option value="{{$month->id}}">{{$month->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Total : </label>
                                            <h4 id="amountText">€ 00.00</h4>
                                            <input hidden type="number" class="form-control" name="amount" id="amount">
                                        </div>
                                        <div class="form-group">
                                            <label for="code">Coupon Code : </label>
                                            <input type="number" class="form-control" name="code" id="code">
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
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
<script>
    $(function () {
        $("select").on("changed.bs.select",
            function (e, clickedIndex, newValue, oldValue) {
                const data = {
                    "month_id": $('#month_id').val()
                };
                getTotalAmount(data);

            });

        function getTotalAmount(data) {

            $.ajax({
                type: "GET",
                url: "{{route('class.getTotal')}}",
                data: data,
                success: function (data, status, xhr) {
                    var total = $('#amount').val(data);
                    document.getElementById("amountText").innerHTML = '€ '+data;
                },
                error: function (data, status, xhr) {
                },

            });
        }
    });
    // $('#month_id').on('change', function () {
    //
    // })

</script>
