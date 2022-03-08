<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Datatable\AnnouncementTable;
use App\Http\Service\ToastMessageServices;
use App\Models\Announcement;
use App\Models\Classe;
use App\Models\Coupon;
use App\Models\Month;
use App\Models\User;
use Carbon\Carbon;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use function response;

class StudentAnnoucementController extends Controller
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
        if ($request->ajax()) {
            $data = Auth::user()->notifications;
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    if ($row->read_at)
                        $btn = 'Read';
                    else
                        $btn = '<a href="' . route('announcementStudent.read', $row->id) . '" class="edit btn btn-danger btn-sm">Mark as Read</a>';

                    return $btn;
                })
                ->addColumn('topic', function ($row) {
                    return $row->data["topic"];
                })
                ->addColumn('message', function ($row) {
                    return $row->data["message"];
                })
                ->rawColumns(['action', 'message','topic'])
                ->make(true);
        }
        return view('StudentPortal.Announcement.index');
    }

    public function read($id){
        dd(Auth::user()->readNotifications()->where('id',$id)->first());
        Auth::user()->unreadNotifications()->where('id',$id)->first()->markAsRead();
        return redirect()->back()->with(ToastMessageServices::generateMessage('Mark as Read'));
    }
    public function dashboardAnno(Request $request){
        return Laratables::recordsOf(User::class,AnnouncementTable::class);
    }
}
