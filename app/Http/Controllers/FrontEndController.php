<?php

namespace App\Http\Controllers;

use App\Ploting;
use App\Recomendation;
use App\Student;
use App\Submission;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrontEndController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:frontend-list', ['only' => ['index','submission','store','getLecturer', 'getFormRecomendation', 'storeRecomendation']]);
    }

    public function index()
    {
        $student = Auth::user()->student;
        return view('front-end.dashboard', compact('student'));
    }

    public function submission()
    {
        $student = Auth::user()->student;
        $topics = Topic::where([
            'faculty_id' => $student->faculty_id,
            'year' => date('Y')
        ])->orderBy('name', 'asc')->get();
        return view('front-end.request', compact('student', 'topics'));

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic_id' => 'required',
            'lecturer_id' => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->route('frontend.submission')->withErrors($validator)->withInput();
        }
        $ploting = Ploting::where([
            'topic_id' => $request->topic_id,
            'lecturer_id' => $request->lecturer_id,
            'year' => date('Y')
        ])->first();

        $hasSubmit = Submission::where([
            'student_id' => Auth::user()->student->id,
            'year' => date('Y')
        ])->first();
        if ($hasSubmit) {
            return redirect()->route('frontend.index')->with(['error' => 'Anda Telah Melakukan Pengajuan!']);
        }

        $submission = new Submission();
            $submission->year = date('Y');
            $submission->student_id = Auth::user()->student->id;
            $submission->ploting_id = $ploting->id;
            $submission->date = date('Y-m-d');
            $submission->save();
            return redirect()->route('frontend.index')->with(['success' => 'Data Berhasil Diajukan!']);
    }

    public function getLecturer($id)
    {
        $plotings = DB::table('lecturers')->join('plotings', 'plotings.lecturer_id', '=', 'lecturers.id')
        ->select('lecturers.id', 'lecturers.name')->where([
            'plotings.topic_id' => $id,
            'plotings.year' => date('Y')
        ])->get();
        return json_encode($plotings);
    }

    public function getFormRecomendation(){
        $student = Auth::user()->student;
        return view('front-end.student_recomendation', compact('student'));
    }

    public function storeRecomendation(Request $request){
        $recomendation = new Recomendation();

        $recomendation->student_id = Auth::user()->student->id;
        $recomendation->title = $request->title;
        $title = $recomendation->tokenizing(mb_strtolower($recomendation->title, "UTF-8"));
        $recomendation->text_processing = $title;
        $kgram = $recomendation->generateKgram();
        return redirect()->route('frontend.index')->with(['success' => 'Data Berhasil Diajukan!']);
    }

}
