<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Service\ToastMessageServices;
use App\Models\Classe;
use App\Models\Month;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class StudentClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');

    }
    public function dashboard(){
        return view('StudentPortal.dashboard');
    }

    public function index(Request $request)
    {
        $months = Month::whereDoesntHave('payment',function ($q){
            return $q->where('user_id',Auth::id());
        })->whereIn('id',Auth::user()->group->classes()->pluck('id')->toArray())->where('end_at', '<', Carbon::now())->get();
        if ($request->ajax()) {
            return DataTables::of($months)
                ->editColumn('id', function ($row) {
                    return $row->name;
                })
                ->addColumn('amount', function ($row) {
                    return $row->fee;
                })
                ->editColumn('action', function ($row) {
                    $btn = '<a href="' . route('class.quickPay',$row->id) . '" class="edit btn btn-success btn-sm">Pay Now</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'amount', 'month_id'])
                ->make(true);
        }
        $classes = Auth::user()->group ? Auth::user()->group->classes : null;
        return view('StudentPortal.classes.index', compact('classes'));
    }

    public function show($id)
    {
        $class = Classe::find($id);
        if (!$class->group_id)
            return redirect()->back()->with(ToastMessageServices::generateMessage('No Access to watch this class', false));
        if ($class->group_id !== Auth::user()->group_id)
            return redirect()->back()->with(ToastMessageServices::generateMessage('No Access to watch this class', false));

        $months = Month::where('classe_id',$class->id)->whereHas('users',function ($q){
            return $q->where('user_id',Auth::id());
        })->pluck('id')->toArray();
        $videos = Video::whereIn('month_id',$months)->orderBy('created_at','asc')->get();
        $quizes = Quiz::whereIn('month_id',$months)->orderBy('created_at','asc')->get();
        return view('StudentPortal.classes.show', compact('class', 'months','videos','quizes'));
    }

    public function playVideo($month_id, $video_id)
    {
        try{
            if (User::whereHas('payment',function($q) use($month_id){
                return $q->where('month_id',$month_id)->where('status','approved');
            })->exists() || Month::where('id',$month_id)->whereHas('users',function ($q){
                    return $q->where('user_id',Auth::id());
                })->exists()){
                $video = Video::findOrFail($video_id);
                return view('StudentPortal.video.show', compact('video'));
            }
            return redirect()->back()->with(ToastMessageServices::generateMessage('No Access to watch this video', false));
        }catch (\Exception  $e){
            return redirect()->back()->with(ToastMessageServices::generateMessage('No Access to watch this video', false));
        }

    }
    public function playQuiz($month_id, $quiz_id)
    {
        try{
            if (User::whereHas('payment',function($q) use($month_id){
                return $q->where('month_id',$month_id)->where('status','approved');
            })->exists() ||  Month::where('id',$month_id)->whereHas('users',function ($q){
                    return $q->where('user_id',Auth::id());
                })->exists()){
                $quiz = Quiz::findOrFail($quiz_id);
                return view('StudentPortal.quiz.show', compact('quiz'));
            }
            return redirect()->back()->with(ToastMessageServices::generateMessage('No Access to watch this quiz', false));
        }catch (\Exception  $e){
            return redirect()->back()->with(ToastMessageServices::generateMessage('No Access to watch this quiz', false));

        }

    }
}
