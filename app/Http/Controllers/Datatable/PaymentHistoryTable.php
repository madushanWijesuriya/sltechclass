<?php

namespace App\Http\Controllers\Datatable;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentHistoryTable
{
    public static function laratablesCustomMonthId($recode){
        return Payment::find($recode->id)->month->name;
    }

//    public static function laratablesCustomAmount($recode){
//        dd('b');
//    }
//    public static function laratablesCustomPaymentMethod($recode){
//        dd('s');
//    }
    public static function laratablesQueryConditions($query)
    {
        return $query->find(Auth::id())->payment();
    }
}
