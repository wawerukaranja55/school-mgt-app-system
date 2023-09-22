<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Exam_Controller extends Controller
{
    // all pupils page
    public function all_exams_page()
    {
        return view('admins.admin_all_exams');
    }

    // add new details for a pupil page
    public function create_new_exam_page()
    {
        return view('admins.admin_add_exam');
    }

    //store subject details 
    public function create_new_exam(Request $request)
    {
        $data=$request->all();
        
        $rules=[
            'year'=>'max:4'
        ];

        $custommessages=[
            'year.max:4'=>'The year should have a maximum of 4 digits'
        ];

        $validator = Validator::make( $data,$rules,$custommessages );
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>405,
                'message'=>$validator->errors()
            ]);
        }else{

            $examcount=Exam::where('exam_name',$data['exam_name'])->count();
            if($examcount>0){
                $message="The Exam name already exists.Kindly Check the it again.";
                return response()->json([
                    'status'=>400,
                    'message'=>$message
                ]);
            }else{

                $exam=new Exam();
                $exam->exam_name=$data['exam_name'];
                $exam->term=$data['term'];
                $exam->year=$data['year'];
                $exam->save();

                $message="Exam registered Successfully,now the results.";

                return response()->json([
                    'status'=>200,
                    'message'=>$message
                ]);
            }
        }
    }

    // get all subject to display into datatable
    public function all_exams(Request $request)
    {
        $allsubjects=Subject::with('subjectgrades')->select('id','subject_name','subject_teacher_id');
        
        if($request->ajax()){
            $allsubjects = DataTables::of ($allsubjects)

            ->addColumn ('subject_teacher_id',function(Subject $subject){
                return $subject->subjectteachers->name;
            })

            ->addColumn ('action',function($row){
                return 
                '
                    <a href="#" title="edit pupil details" class="btn btn-success editpupildetails" data-id="'.$row->id.'"><i class="fa-solid fa-edit"></i></a>

                    <a href="/viewsubjectdetails/'.$row->id.'" target="_blank" title="view subject details"  class="btn btn-primary viewpupilpayment" data-id="'.$row->id.'"><i class="fa-solid fa-eye"></i></a>

                    <a href="/viewpupilperfomance/'.$row->id.'" target="_blank" title="delete subject details"  class="btn btn-danger viewpupildetails" data-id="'.$row->id.'"><i class="fa-solid fa-trash"></i></a>
                ';
            })
            ->rawColumns(['subject_teacher_id','action'])
            ->make(true);

            return $allsubjects;
        }
    }
}
