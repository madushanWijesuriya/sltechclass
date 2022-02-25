<?php

namespace App\Http\Controllers;

use App\Http\Service\ToastMessageServices;
use App\Models\Classe;
use App\Models\Group;
use App\Models\Month;
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

class ClassController extends Controller
{
    /**
     * ClassController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Classe::select('*');
            return DataTables::of($data)
                ->addColumn('url', function ($row) {
                    return '<img src="' . asset('/class_thumbnails/' . $row->url) . '" border="0" width="120" height="80" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('class.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> <a href="' . route('class.deleteClass', $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action', 'url'])
                ->make(true);
        }
        return view('class.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('class.create');
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
            'name' => ['required', 'unique:classes', 'string'],
            'url' => ['required', 'image'],
        ]);
        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        $img_ext = $request->file('url')->getClientOriginalExtension();
        $filename = time() . '.' . $img_ext;
        $path = $request->file('url')->move(public_path() . '/class_thumbnails/', $filename);

        try {
            if (Classe::create(['name' => $request->input('name'), 'url' => $filename]))
                return redirect()->back()->with(ToastMessageServices::generateMessage('successfully added'));

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
        $class = Classe::find($id);
        $months = $class->months;
        return view('class.edit', compact('class', 'months'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ]);
        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        if ($request->hasFile('thumbnail')) {
            $img_ext = $request->file('thumbnail')->getClientOriginalExtension();
            $filename = time() . '.' . $img_ext;
            $request->file('thumbnail')->move(public_path() . '/class_thumbnails/', $filename);
            unlink(public_path() . '/class_thumbnails/' . $request->input('current_url'));
        } else {
            $filename = $request->input('current_url');
        }

        try {
            if (Classe::find($id)->update(['name' => $request->input('name'), 'url' => $filename]))
                return redirect()->back()->with(ToastMessageServices::generateMessage('successfully updated'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot update', false));

        } catch (Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot update', false));
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteClass($id): RedirectResponse
    {
        try {

            if (Classe::find($id)->delete())
                return redirect()->back()->with(ToastMessageServices::generateMessage('successfully deleted'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Delete', false));

        } catch (Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage($e->getMessage(), false));
        }
    }

    public function classSetting(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')->where('type','student')->with(['group']);
            return DataTables::of($data)
                ->editColumn('group.name',function ($row){
                    return $row->group ? $row->group->name : "N/A";
                })

                ->make(true);
        }
        $groups = Group::all();
        $students = User::where('type', 'student')->get();
        $months = Month::all();
        return view('class.setting.class_setting', compact('groups', 'students', 'months'));
    }
}
