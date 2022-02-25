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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class GroupController extends Controller
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
            $data = Group::select('*');
            return DataTables::of($data)
                ->addColumn('no_of_stud', function ($row) {
                    return $row->users->count();
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('group.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> <a href="' . route('group.deleteGroup', $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('groups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classe::all();
        return view('groups.create',compact('classes'));
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
            'name' => ['required', 'unique:groups', 'string'],
            'class_id.*' => ['required', 'exists:classes,id'],
        ]);
        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        try {
            $group = Group::create($request->all());
            if ($group) {
                if (Classe::whereIn('id', $request->input('class_id'))->update(['group_id' => $group->id]))
                    return redirect()->back()->with(ToastMessageServices::generateMessage('successfully added'));
                return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot assign classes'));
            }
            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));

        } catch (Exception $e) {
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
        $group = Group::find($id);
        $classes = Classe::all();
        return view('groups.edit',compact('group','classes'));
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
            'name' => ['required', 'string'],
            'class_id' => ['required', 'exists:classes,id'],
        ]);
        $group = Group::find($id);
        if (Group::where('name', $request->input('name'))->where('id','!=',$group->id)->exists())
            return redirect()->back()->with(ToastMessageServices::generateMessage('Name is Already Taken', false));

        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        try {
            if ($group->update($request->all()))
                return redirect()->back()->with(ToastMessageServices::generateMessage('successfully Updated'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Updated', false));

        } catch (Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Updated', false));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteGroup($id)
    {
        try {
            DB::beginTransaction();
            $group = Group::find($id);
            if ($group->users()->update(['group_id' => null]) && $group->delete())
                return redirect()->back()->with(ToastMessageServices::generateMessage('successfully deleted'));

            DB::rollBack();
            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Delete', false));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(ToastMessageServices::generateMessage($e->getMessage(), false));
        }
    }


    public function getMonthByGroup(Request $request){
        if (!$request->has('group_id') || !Group::find($request->input('group_id'))){
            return response()->json([]);
        }

        $tags = Classe::where('group_id',$request->input('group_id'))->pluck('id')->toArray();
        $tags = Month::whereIn('class_id',$tags)->get();
        $formatted_tags = [];

        foreach ($tags as $tag) {
            dd($tags);
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name];
        }

        return response()->json($formatted_tags);
    }
}
