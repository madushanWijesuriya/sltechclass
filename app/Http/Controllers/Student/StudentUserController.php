<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Service\ToastMessageServices;
use App\Models\Classe;
use App\Models\Month;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use function response;

class StudentUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $classes = Auth::user()->group ? Auth::user()->group->classes : null;
        return view('StudentPortal.my_class', compact('classes'));
    }

    public function payNow($id)
    {
        $months = Classe::find($id)->months;
        return view('StudentPortal.payNow', compact('months'));
    }

    public function getTotal(Request $request)
    {
        $total = 0;
        if ($request->has('month_id')) {
            $total = Month::find($request->input('month_id'))->sum('fee');
        }

        return response(json_encode($total));
    }
    public function checkout(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'month_id.*' => ['required', 'exists:months,id'],
            'amount' => ['required'],
        ]);
        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        $month_ids = "";
        foreach ($request->input('month_id') as $id){
            $month_ids .= $id.',';
        }

        $data = [
            'checkout_url' => env('PAY_HERE'),
            'merchant_id' => env('MERCHANT_ID'),
            'notify_url' => route('notify'),
            'return_url' => route('return'),
            'cancel_url' => route('cancel'),
            'first_name' => Auth::user()->name,
            'last_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->tel,
            'address' => "",
            'city' => "",
            'country' => "",
            'order_id' => $month_ids,
            'items' => "",
            'custom_1' => json_encode($request->input('month_id')),
            'currency' => env('CURRENCY'),
            'amount' => (float)$request->input('amount'),
            'months' => $request->input('month_id')
        ];

        return view('StudentPortal.pay_here_checkout', compact('data'));
    }


    public function delayPayment(Request $request)
    {
        $data = Auth::user()->months()->where('end_at', '<', Carbon::now())->with('months')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('month_id', function ($row) {

                    return $row->months()->first()->name;
                })
                ->editColumn('user_id', function ($row) {
                    return $row->codice_id;
                })
                ->addColumn('amount', function ($row) {
                    return $row->months()->first()->fee;
                })
                ->editColumn('action', function ($row) {
                    $btn = '<a href="' . route('payment.sendWarning', ['user_id' => $row->id, 'month_id' => $row->months()->first()->id]) . '" class="edit btn btn-success btn-sm">Send Warning</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'amount', 'month_id'])
                ->make(true);
        }
        return view('payments.delay.index');
    }
}
