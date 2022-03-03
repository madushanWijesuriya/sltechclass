<?php

namespace App\Http\Controllers;

use App\Http\Service\ToastMessageServices;
use App\Models\Month;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\DelayPaymentWarning;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::select('*')->where('status', 'pending');
            return DataTables::of($data)
                ->editColumn('url', function ($row) {
                    return '<img src="' . asset('/bank_receipts/' . $row->url) . '" border="0" width="120" height="80" class="img-rounded" align="center" />';
                })
                ->editColumn('user_id', function ($row) {
                    return User::find($row->user_id)->codice_id;
                })
                ->editColumn('month_id', function ($row) {
                    return Month::find($row->month_id)->name;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('payment.approve', $row->id) . '" class="edit btn btn-success btn-sm">Approve</a>';

                    return $btn;
                })
                ->rawColumns(['action', 'url'])
                ->make(true);
        }
        return view('payments.pending.index');
    }

    public function receivedIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::select('*')->where('status', 'approved');
            return DataTables::of($data)
                ->editColumn('user_id', function ($row) {
                    return User::find($row->user_id)->codice_id;
                })
                ->editColumn('month_id', function ($row) {
                    return Month::find($row->month_id)->name;
                })
                ->rawColumns(['url'])
                ->make(true);
        }
        return view('payments.recieved.index');
    }

    public function delayedIndex(Request $request)
    {
        $data = User::where('type', 'student')->whereHas('months', function ($q) {
            return $q->where('end_at', '<', Carbon::now())->doesntHave('payment');
        })->with('months')->get();
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

    public function approve($id): RedirectResponse
    {
        $payment = Payment::find($id)->update(['status' => 'approved']);
        return redirect()->back()->with(ToastMessageServices::generateMessage('Payment Approved'));
    }

    public function sendWarning($user_id, $month_id): RedirectResponse
    {
        $student = User::find($user_id);
        $month = Month::find($month_id);
        Notification::send($student, new DelayPaymentWarning($month->name));

        return redirect()->back()->with(ToastMessageServices::generateMessage('Send Warning'));
    }
}
