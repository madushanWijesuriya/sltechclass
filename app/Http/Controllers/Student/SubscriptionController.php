<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Month;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');

    }

    public function notify(Request $request)
    {

        $merchant_id = $request->merchant_id;
        $order_id = $request->order_id;
        $payhere_amount = $request->payhere_amount;
        $payhere_currency = $request->payhere_currency;
        $status_code = $request->status_code;
        $md5sig = $request->md5sig;
        $merchant_secret = env('MERCHANT_SECRET');
        $local_md5sig = strtoupper(md5($merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret))));

        if (($local_md5sig === $md5sig) and ($status_code == 2)) {
            $month_ids = json_decode($request->custom_1);
            foreach (Month::find($month_ids) as $month) {
                $month->users()->syncWithoutDetaching(Auth::user()->id);
            }
        }
    }

    public function return(Request $request)
    {
        $months = explode(",", $request->order_id);
        array_pop($months);
        $months = Month::find($months);
        return view('StudentPortal.payNow', compact('months'));
    }

    public function cancel(Request $request)
    {
        $months = explode(",", $request->order_id);
        array_pop($months);
        $months = Month::find($months);
        return view('StudentPortal.payNow', compact('months'));
    }

    //direct
    public function directPay(Request $request){
        dd($request);
    }
}
