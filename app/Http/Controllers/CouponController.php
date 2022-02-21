<?php

namespace App\Http\Controllers;

use App\Http\Service\ToastMessageServices;
use App\Models\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
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
            $data = Coupon::select('*');
            return DataTables::of($data)
                ->editColumn('end_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('m:d:Y h:m:s');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('coupon.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> <a href="' . route('coupon.deleteCoupon', $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('coupons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $students = User::where('type', 'student')->get();
        return view('coupons.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'code' => ['required', 'unique:coupons', 'string'],
            'percentage' => ['required'],
            'period' => ['required'],
            'user_id' => ['required', 'exists:users,id'],
        ]);
        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        try {
            $dates = explode(' - ', $request->input('period'));
            if (Coupon::create([
                'code' => $request->input('code'),
                'percentage' => $request->input('percentage'),
                'user_id' => $request->input('user_id'),
                'start_at' => Carbon::parse($dates[0])->startOfDay(),
                'end_at' => Carbon::parse($dates[1])->endOfDay(),
            ]))
                return redirect()->route('coupon.index')->with(ToastMessageServices::generateMessage('successfully added'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));

        } catch (Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $students = User::where('type','student')->get();
        return view('coupons.edit', compact('coupon','students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'code' => ['required', 'string'],
            'percentage' => ['required'],
            'user_id' => ['required', 'exists:users,id'],
        ]);
        $coupon = Coupon::find($id);
        //after validated
        if (Coupon::where('code', $request->input('code'))->where('id','!=',$coupon->id)->exists())
            return redirect()->back()->with(ToastMessageServices::generateMessage('Code is Already Taken', false));


        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);
        try {
            if ($request->input('period')) {
                $dates = explode(' - ', $request->input('period'));
                $start = Carbon::parse($dates[0])->startOfDay();
                $end = Carbon::parse($dates[1])->endOfDay();
            } else {
                $start = $coupon->start_at;
                $end = $coupon->end_at;
            }
            if ($coupon->update([
                'code' => $request->input('code'),
                'percentage' => $request->input('percentage'),
                'user_id' => $request->input('user_id'),
                'start_at' => $start,
                'end_at' => $end,
            ]))
                return redirect()->back()->with(ToastMessageServices::generateMessage('successfully updated'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot updated', false));

        } catch (Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot updated', false));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteCoupon($id): RedirectResponse
    {
        try {
            if (Coupon::find($id)->delete())
                return redirect()->back()->with(ToastMessageServices::generateMessage('successfully deleted'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Delete', false));
        } catch (\Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage($e->getMessage(), false));
        }
    }
}
