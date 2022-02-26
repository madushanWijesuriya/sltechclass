<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Service\ToastMessageServices;
use App\Models\Classe;
use App\Models\Group;
use App\Models\Month;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')->where('type','student')->with(['group']);
            return DataTables::of($data)
                ->editColumn('created_at',function ($row){
                    return Carbon::parse($row->created_at)->format('m:d:Y h:m:s');
                })
                ->editColumn('group.name',function ($row){
                    return $row->group ? $row->group->name : "N/A";
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('student.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> <a href="' . route('student.deleteStudent', $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $groups = Group::all();
        return view('students.create',compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'codice_id' => ['required', 'unique:users,codice_id','string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'group_id' => ['required', 'exists:groups,id'],
        ]);
        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        try {
            $group = Group::find($request->input('group_id'));
            if ($group->users()->create(collect($request->only(['codice_id','email','tel']))->merge([
                'name' => $request->input('codice_id'),
                'password' => Hash::make($request->input('password')),
            ])->toArray()))
                return redirect()->route('student.index')->with(ToastMessageServices::generateMessage('successfully added'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));

        } catch (\Exception $e) {
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
        $groups = Group::all();
        $student = User::where('type','student')->find($id);
        return view('students.edit',compact('student','groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'codice_id' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'group_id' => ['required', 'exists:groups,id'],
        ]);

        $student = User::where('type','student')->find($id);
        if (User::where('codice_id', $request->input('codice_id'))->where('id','!=',$student->id)->exists())
            return redirect()->back()->with(ToastMessageServices::generateMessage('Codice ID is Already Taken', false));
        if (User::where('email', $request->input('email'))->where('id','!=',$student->id)->exists())
            return redirect()->back()->with(ToastMessageServices::generateMessage('Email is Already Taken', false));

        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        try {
            if ($student->update(collect($request->only(['codice_id','email','tel','group_id']))->merge([
                'name' => $request->input('codice_id'),
            ])->toArray()))
                return redirect()->route('student.index')->with(ToastMessageServices::generateMessage('successfully added'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));

        } catch (\Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteStudent($id): \Illuminate\Http\RedirectResponse
    {
        try {
            if (User::where('type','student')->find($id)->delete())
                return redirect()->back()->with(ToastMessageServices::generateMessage('successfully deleted'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Delete', false));
        } catch (\Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage($e->getMessage(), false));
        }
    }

}
