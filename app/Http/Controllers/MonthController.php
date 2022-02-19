<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Service\ToastMessageServices;
use App\Models\Classe;
use App\Models\Month;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Nette\Schema\ValidationException;

class MonthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('month.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $class_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createMonth($id)
    {
        return view('months.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'fee' => ['required'],
            'class_id' => ['required','exists:classes,id'],
            'period' => ['required'],
        ]);
        $class = Classe::find($request->input('class_id'));
        //after validate
        if ($class->months()->where('name',$request->input('name'))->exists())
            return redirect()->back()->with(ToastMessageServices::generateMessage('Name is Already Taken',false));

        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);
        try{

            $dates = explode(' - ' ,$request->input('period'));

            $class->months()->create([
                'fee' => (double)$request->input('fee'),
                'name' => $request->input('name'),
                'start_at' => Carbon::parse($dates[0])->startOfDay(),
                'end_at' => Carbon::parse($dates[1])->endOfDay(),
            ]);

            return redirect()->back()->with(ToastMessageServices::generateMessage('successfully added'));

        }catch(\Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));

        }

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $month = Month::find($id);
        return view('months.edit',compact('month'));
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
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'fee' => ['required'],
        ]);
        $month = Month::find($id);
        $class = $month->classe;
        //after validate
        if ($class->months()->where('name',$request->input('name'))->exists() && $month->name !== $request->input('name'))
            return redirect()->back()->with(ToastMessageServices::generateMessage('Name is Already Taken',false));

        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);
        try{

            if ($request->input('period')) {
                $dates = explode(' - ' ,$request->input('period'));
                $start = Carbon::parse($dates[0])->startOfDay();
                $end = Carbon::parse($dates[1])->endOfDay();
            } else {
                $start = $month->start_at;
                $end = $month->end_at;
            }
            $month->update([
                'fee' => (double)$request->input('fee'),
                'name' => $request->input('name'),
                'start_at' => $start,
                'end_at' => $end,
            ]);

            return redirect()->back()->with(ToastMessageServices::generateMessage('successfully added'));

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id
        );
    }
}
