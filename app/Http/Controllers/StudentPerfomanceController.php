<?php

namespace App\Http\Controllers;

use App\Models\Pupil;
use Barryvdh\DomPDF\PDF;
use App\Models\Exam_Result;
use Illuminate\Http\Request;
use App\Models\Student_Perfomance;
use Yajra\DataTables\Facades\DataTables;

class StudentPerfomanceController extends Controller
{
    public function all_pupil_perfomance_page()
    {
        return view('admins.pupil_by_term_perfomance');
    }

    // get all exam results to display into datatable
    public function get_pupil_perfomances(Request $request)
    {
        $allpupilperfomances=Student_Perfomance::with(['pupilresultsname','pupilresultsgrade'])->get();

        if($request->ajax()){
            $allpupilperfomances = DataTables::of ($allpupilperfomances)

            ->addColumn ('pupil_id',function(Student_Perfomance $student_perfomance){
                return $student_perfomance->pupilresultsname->pupil_name;
            })

            ->addColumn ('action',function($row){
                return
                '   <a href="/admin/view_pupil_perfomance/'.$row->pupil_id.'/'.$row->term.'/'.$row->year.'" target="_blank" title="View Pupil Perfomance"  class="btn btn-primary viewpupilperfomance" data-id="'.$row->id.'"><i class="fa-solid fa-eye"></i></a>

                    <a href="/admin/download_pupil_perfomance/'.$row->pupil_id.'/'.$row->term.'/'.$row->year.'" target="_blank" title="Download Pupil Perfomance"  class="btn btn-danger downloadpupilperfomance" data-id="'.$row->id.'"><i class="fa-solid fa-download"></i></a>
                ';
            })
            ->rawColumns(['pupil_id','action'])
            ->make(true);

            return $allpupilperfomances;
        }
    }

    // view the results for a pupil
    public function view_pupil_perfomance($id,$term,$year)
    {
        $pupilid=((int) $id);
        $pupildetails=Pupil::where('id',$pupilid)->first();

        $pupilmean=Student_Perfomance::where(['term'=>$term,'term'=>$term,'year'=>$year,'id'=>$pupilid])->first();
        $pupilresults=Exam_Result::with('studentgrade','pupilexam')->where(['term'=>$term,'year'=>$year,'student_id'=>$pupilid])->get();

        return view('documents.pupil_term_report_card',compact('pupilresults','pupildetails','pupilmean'));
    }

    // generate and download pdf
    public function generate_pupil_perfomance_pdf($id,$term,$year)
    {
        $pupilid=((int) $id);
        $pupildetails=Pupil::where('id',$pupilid)->first();

        $pupilmean=Student_Perfomance::where(['term'=>$term,'term'=>$term,'year'=>$year,'id'=>$pupilid])->first();
        $pupilresults=Exam_Result::with('studentgrade','pupilexam')->where(['term'=>$term,'year'=>$year,'student_id'=>$pupilid])->get();

        $data = [
            'pupilresults'=> $pupilresults,
            'pupildetails'=> $pupildetails,
            'pupilmean'=> $pupilmean
        ];

        view()->share($data);
        $examresultspdf=app()->make(PDF::class); 
        $examresultspdf->loadView('documents.pupil_term_report_card',$data); 
        return $examresultspdf->download(''.$pupildetails->pupil_name.' Perfomance for the term.pdf');
    }
}
