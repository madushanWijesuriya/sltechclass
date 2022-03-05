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
                            <h3 class="card-title">Direct Bank Transfer</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-6">
{{--                                <img src="{{'/dist/img/credit/visa.png'}}" alt="Visa">--}}
{{--                                <img src="{{'/dist/img/credit/mastercard.png'}}" alt="Mastercard">--}}
{{--                                <img src="{{'/dist/img/credit/american-express.png'}}" alt="American Express">--}}
{{--                                <img src="{{'/dist/img/credit/paypal2.png'}}" alt="Paypal">--}}

                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">ඔබේ ගෙවීම තහවුරු කිරිමට ගෙවීම් පත්‍රයේ පින්තූරයක් upload කර Submit බොත්තම ඔබන්න</p>
                                සැ.‍යු: ඔබේ ගෙවීම තහවුරු වූ පසු ඔබට පන්තිය සමග සම්බන්ද විය හැක.


                            </div>
                            <br>
                            <form id="directForm" action="{{route('directPay')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$data["order_id"]}}">
                                <div class="form-group">
                                    <label for="url">බොත්තම ඔබන්න පෙර image එක upload කරන්න:</label>
                                    <span style="color:#ff0000"></span>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="url" id="url" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-11 col-sm-12 col-md-8"></div>
                                    <div class="col-lg-1 col-sm-12 col-md-4">
                                        @include('components.primary_btn',['form'=>'directForm' ,'name' => "Direct Pay", "id"=>"direct"])
                                    </div>
                                </div>
                            </form>
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
