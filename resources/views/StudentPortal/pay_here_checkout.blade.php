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

                            @if(isset($data['code']))
                                <label for="tot_amt">Total Amount : </label>
                                <span id="tot_amt">€ {{\App\Models\Month::find($data["months"])->sum('fee')}}</span><br>
                                <label for="dis">Discount : </label>
                                <span id="dis">
                                    € {{\App\Models\Month::find($data["months"])->sum('fee') - $data["amount"]}}</span>
                                <br>
                            @endif
                            <label for="amount">Total Payable : </label>
                            <span id="amountText">€ {{$data["amount"]}}</span>
                            <br>
                            <br>
                            <div class="container">
                                <div class="row" style="text-align: center">
                                    <b>
                                        ඔබගේ බැංකු විස්තර සදහා උපරිම ආරක්ශාව ලබා දෙමු !​
                                    </b>
                                </div>
                            </div>
                            <form action="{{$data["checkout_url"]}}" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card-body" style="background-color: rgba(237,245,234,0.95)">
                                            <b>බැංකු කාඩ්පත භාවිතා කරමින් ගෙවීම සිදු කරන්න​</b>
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <img width="60px" height="40px" src="{{asset('/1.png')}}"
                                                         loading="lazy">
                                                </div>
                                                <div class="col">
                                                    <img width="60px" height="40px" src="{{asset('/2.png')}}"
                                                         loading="lazy">
                                                </div>
                                                <div class="col">
                                                    <img width="60px" height="40px" src="{{asset('/3.jpg')}}"
                                                         loading="lazy">
                                                </div>
                                                <div class="col">
                                                    <img width="60px" height="40px" src="{{asset('/4.jpg')}}"
                                                         loading="lazy">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <b>ඔබගේ බැංකු කාඩ් පත භාවිතා කරමින් ගෙවීම සම්පූර්ණ කරන්න ​</b>
                                            <div class="row">
                                                @include('components.primary_btn',['is_white'=>true,'name' => "Card Payment",'class_name'=>'btn btn-flat primary_btn float-right navbar-orange text-white'])
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="card-body" style="background-color: rgba(237,245,234,0.95)">
                                            <b>වෙනත් අයුරින් ගෙවීම් සිදු කර රිසිට් පත අපවෙත එවන්න​</b>
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <img width="60px" height="40px" src="{{asset('/5.jpg')}}"
                                                         loading="lazy">
                                                </div>
                                                <div class="col">
                                                    <img width="120px" height="40px" src="{{asset('/8.png')}}"
                                                         loading="lazy">
                                                </div>
                                                <div class="col">
                                                    <img width="120px" height="40px" src="{{asset('/7.jpg')}}"
                                                         loading="lazy">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <b>ඔබ Tabacchi , Poste italiano හෝ වෙනත් මාර්ග වලින් ගෙවීම් කර පසුව ගෙවීම්
                                                කල රිසිට් පත අනිවාර්යයෙන් මේ මගින් අපවෙත එවීමෙන් ඔබගේ ගෙවීම සම්පූර්ණ
                                                කරන්න ​</b>
                                            <div class="row">
                                                @include('components.primary_btn',['is_white'=>true,'form'=>'directForm' ,'name' => "Upload Payment", "id"=>"direct",'class_name'=>'btn btn-flat primary_btn float-right navbar-blue text-white secondary_btn'])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

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
                                <input type="hidden" name="last_name" value="{{$data["last_name"]}}">
                                <input type="hidden" name="email" value="{{$data["email"]}}">
                                <input type="hidden" name="phone" value="{{$data["phone"]}}">
                                <input type="hidden" name="address" value="{{$data["address"]}}">
                                <input type="hidden" name="city" value="{{$data["city"]}}">
                                <input type="hidden" name="country" value="{{$data["country"]}}">
                                <input type="hidden" name="custom_1" value="{{$data["custom_1"]}}"><br><br>
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-6 col-sm-6 col-md-6">--}}
{{--                                        <b>ඔබගේ බැංකු විස්තර සදහා උපරිම ආරක්ශාව ලබා දෙමු !​</b>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-6 col-sm-6 col-md-6">--}}

{{--                                    </div>--}}

{{--                                </div>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-6 col-sm-6 col-md-6">--}}
{{--                                        @include('components.primary_btn',['name' => "Card Payment"])--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-6 col-sm-6 col-md-6">--}}
{{--                                        @include('components.primary_btn',['form'=>'directForm' ,'name' => "Upload Payment", "id"=>"direct"])--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <!-- /.card-body -->

                            </form>
                            <form id="directForm" action="{{route('class.directBank')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$data["order_id"]}}">
                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="url">Please upload bank receipt before make direct payment:</label>--}}
                                {{--                                    <span style="color:#ff0000"></span>--}}
                                {{--                                    <div class="input-group">--}}
                                {{--                                        <div class="custom-file">--}}
                                {{--                                            <input type="file" name="url" id="url" required>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
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

