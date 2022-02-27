<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Month;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Payment::select('*');
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
