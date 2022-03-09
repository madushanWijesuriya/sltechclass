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
                            <div class="container">
                                <div class="row" style="text-align: center">
                                    <b>
                                        පහත විස්තර අනුව ඔබගේ ගෙවීම් කටයුතු සිදු කරන්න
                                    </b>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-0 col-lg-2 col-md-2"></div>
                                    <div class="col-sm-12 col-lg-8 col-md-10">
                                        <div class="card-body" style="background-color: rgba(237,245,234,0.95)">
                                            <div class="row">
                                                <div class="col-sm-2 col-lg-4 col-md-3">
                                                    <img width="120px" height="40px" src="{{asset('/8.png')}}"
                                                         loading="lazy">
                                                </div>
                                                <div class="col-sm-0 col-lg-1 col-md-2"></div>
                                                <div class="col-sm-10 col-lg-7 col-md-7">
                                                    <b>Card Number - 5333 1711 2598 2484</b><br>
                                                    <b>Codici Fiscale - MNTDSH89A09Z209M</b>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-0 col-lg-2 col-md-2"></div>

                                </div>
                                <br>
                                <div class="row" style="text-align:center">
                                    <b>
                                        ගෙවීම් සිදු කිරීමේදී වැඩි දුර ගෙවීම පිලිබද තොරතුරු අවශ්‍ය නම් අපව whatsapp
                                        මාර්ගයෙන් සම්භන්ධ කර ගන්න ​
                                    </b>
                                </div>
                                <br>

                                <div class="row" style="text-align:center">
                                    <b>
                                        ඔබ සිදු කල ගෙවීමේ රිසිට් පත උපරිම දවස් 02ක් ඇතුලත අපවෙත එවන්න, ගෙවීම් කල දින සිට
                                        දවස් 02 ඉක්මවූ විට ගෙවීම වලංගු නොවන බව මතක තබා ගන්න ! ​
                                    </b>
                                </div>
                                <br>

                                <div class="row" style="text-align:center">
                                    <b>
                                        ඔබ සිදු කල ගෙවීමේ රිසිට් පත පහතින් අපවෙත එවන්න ( Upload )​
                                    </b>
                                </div>
                                <br>

                            </div>
                            <br>
                            <br>
                            <div class="row" style="text-align:center">
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
                                </form>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    @include('components.primary_btn',['is_white'=>true,'form'=>'directForm' ,'name' => "Direct Pay", "id"=>"direct",'class_name'=>'btn btn-flat primary_btn float-right navbar-blue text-white secondary_btn'])
                                </div>
                            </div>
                            <br>
                            <br>
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
