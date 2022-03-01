@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Class</a></li>
                        <li class="breadcrumb-item active">Payment</li>
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
                            <h3 class="card-title">Confirm Payment</h3>
                        </div>
                        <div class="card-body">
                            @foreach($data["months"] as $month)
                                <h4>Month - {{\App\Models\Month::find($month)->name}}</h4>
                                <br>
                            @endforeach
                            <label for="amount">Total : </label>
                            <h4 id="amountText">€ {{$data["amount"]}}</h4>

                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{$data["checkout_url"]}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="merchant_id" value="{{$data["merchant_id"]}}">
                                <input type="hidden" name="return_url" value="{{$data["return_url"]}}">
                                <input type="hidden" name="cancel_url" value="{{$data["cancel_url"]}}">
                                <input type="hidden" name="notify_url" value="{{$data["notify_url"]}}">
                                <input type="hidden" name="order_id" value="{{$data["order_id"]}}">
                                <input type="hidden" name="items" value="{{$data["items"]}}"><br>
                                <input type="hidden" name="currency" value="{{$data["currency"]}}">
                                <input type="hidden" name="amount" value="{{$data["amount"]}}">
                                <input type="hidden" name="first_name" value="{{$data["first_name"]}}">
                                <input type="hidden" name="last_name" value="{{$data["last_name"]}}"><br>
                                <input type="hidden" name="email" value="{{$data["email"]}}">
                                <input type="hidden" name="phone" value="{{$data["phone"]}}"><br>
                                <input type="hidden" name="address" value="{{$data["address"]}}">
                                <input type="hidden" name="city" value="{{$data["city"]}}">
                                <input type="hidden" name="country" value="{{$data["country"]}}"><br><br>
                                <input type="hidden" name="custom_1" value="{{$data["custom_1"]}}"><br><br>
                                <div class="row">
                                    <div class="col-lg-8 col-sm-12 col-md-6"></div>
                                    <div class="col-lg-2 col-sm-12 col-md-3">
                                        @include('components.primary_btn',['name' => "Pay Online"])
                                    </div>
                                    <div class="col-lg-1 col-sm-12 col-md-3">
                                        @include('components.primary_btn',['form'=>'directForm' ,'name' => "Direct Pay", "id"=>"direct"])
                                    </div>
                                </div>

                                <!-- /.card-body -->

                            </form>
                            <form id="directForm" action="{{route('directPay')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$data["order_id"]}}">
                                <div class="form-group">
                                    <label for="url">Please upload bank receipt before make direct payment:</label>
                                    <span style="color:#ff0000"></span>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="url" id="url" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br>

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
        $('#direct').click('on', function () {
            if ($('#url').val()){
                $("#directForm").submit();
            }
        })
    })
</script>
