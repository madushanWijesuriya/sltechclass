<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Service\ToastMessageServices;
use App\Models\Classe;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class StudentClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');

    }

    public function index()
    {
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

        $months = $class->months;
        return view('StudentPortal.classes.show', compact('class', 'months'));
    }

    public function playVideo($month_id, $video_id)
    {
        try{
            if (User::whereHas('payment',function($q) use($month_id){
                return $q->where('month_id',$month_id)->where('status','approved');
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
