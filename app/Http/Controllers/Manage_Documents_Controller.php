<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use App\Models\Exam_Result;
use Illuminate\Http\Request;
use App\Models\Exam_pupil_Pivot;

class Manage_Documents_Controller extends Controller
{
    // view the results for a pupil
    public function view_pupil_results($id,$exam_id)
    {
        $examid=((int) $exam_id);
        $pupilid=((int) $id);
        $pupilresults=Exam_Result::with('pupilname','studentgrade','pupilexam')->where(['exam_id'=>$examid,'student_id'=>$pupilid])->first();

        $totalMarksAndMean=Exam_pupil_Pivot::where(['exam_id'=>$examid,'pupil_id'=>$pupilid])->get(['total_marks','mean']);

        return view('documents.pupil_report_card',compact('totalMarksAndMean','pupilresults'));
    }

    // generate and download pdf
    public function generate_pupil_results_pdf($id,$exam_id)
    {
        $examid=((int) $exam_id);
        $pupilid=((int) $id);
        $pupilresults=Exam_Result::with('pupilname','studentgrade','pupilexam')->where(['exam_id'=>$examid,'student_id'=>$pupilid])->first();

        $totalMarksAndMean=Exam_pupil_Pivot::where(['exam_id'=>$examid,'pupil_id'=>$pupilid])->get(['total_marks','mean']);

        $data = [
            'pupilresults'=> $pupilresults,
            'totalMarksAndMean' => $totalMarksAndMean
        ];

        view()->share($data);
        $examresultspdf=app()->make(PDF::class); 
        $examresultspdf->loadView('documents.pupil_report_card',$data); 
        return $examresultspdf->download('Pupil Results.pdf');
    }
}
