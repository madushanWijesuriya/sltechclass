<?php

namespace App\Http\Controllers;

use App\Http\Service\ToastMessageServices;
use App\Models\Announcement;
use App\Models\Group;
use App\Models\User;
use App\Notifications\AnnouncementNotification;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Announcement::select('*');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('announcement.deleteAnnouncement', $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action', 'url'])
                ->make(true);
        }
        return view('announcements.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $students = User::where('type', 'student')->get();
        $groups = Group::all();
        return view('announcements.create', compact('students', 'groups'));
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
            'topic' => ['required', 'string'],
            'message' => ['required', 'string'],
            'group_id.*' => ['nullable', 'exists:groups,id'],
            'user_id.*' => ['nullable', 'exists:users,id'],
        ]);
        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        try {
            $anno = Announcement::create($request->all());
            if ($anno) {
                if ($request->input('group_id') && $request->input('user_id')) {
                    $students = User::whereIn('group_id', $request->input('group_id'))->whereIn('id', $request->input('user_id'))->get();
                } else if ($request->input('group_id')) {
                    $students = User::whereIn('group_id', $request->input('group_id'))->get();
                } else if ($request->input('user_id')) {
                    $students = User::find($request->input('user_id'));
                } else {
                    $students = User::whereNotNull('group_id')->get();
                }
                //send notification
                Notification::send($students, new AnnouncementNotification($anno->topic, $anno->message));
            }

            return redirect()->route('announcement.index')->with(ToastMessageServices::generateMessage('successfully added'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));

        } catch (Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage($e->getMessage(), false));
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
     * @return Response
     */
    public function edit($id)
    {

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
            'topic' => ['required', 'string'],
            'message' => ['required', 'string'],
            'group_id.*' => ['nullable', 'exists:groups,id'],
            'user_id.*' => ['nullable', 'exists:users,id'],
        ]);
        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        try {
            $anno = Announcement::find($id);

            if ($anno->update($request->all())) {
                if ($request->input('group_id') && $request->input('user_id')) {
                    $students = User::whereIn('group_id', $request->input('group_id'))->whereIn('id', $request->input('user_id'))->get();
                } else if ($request->input('group_id')) {
                    $students = User::whereIn('group_id', $request->input('group_id'))->get();
                } else if ($request->input('user_id')) {
                    $students = User::find($request->input('user_id'));
                } else {
                    $students = User::whereNotNull('group_id')->get();
                }
                //send notification
                Notification::send($students, new AnnouncementNotification($anno->topic, $anno->message));
            }

            return redirect()->route('announcement.index')->with(ToastMessageServices::generateMessage('successfully added'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));

        } catch (Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage($e->getMessage(), false));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteAnnouncement($id)
    {
        try {
            if (Announcement::find($id)->delete())
                return redirect()->back()->with(ToastMessageServices::generateMessage('successfully deleted'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Delete', false));
        } catch (\Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage($e->getMessage(), false));
        }
    }
}
