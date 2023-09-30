<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Term;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
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
        $allterms=Term::get();
        return view('admins.admin_add_exam',compact('allterms'));
    }

    //store subject details 
    public function create_new_exam(Request $request)
    {
        $data=$request->all();
        
        $rules=[
            'year'=>'digits:4|numeric'
        ];

        $custommessages=[
            'year.digits:4'=>'The year should have a maximum of 4 digits',
            'year.numeric'=>'The year should be numbers only'
        ];

        $validator = Validator::make( $data,$rules,$custommessages );
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>405,
                'message'=>$validator->errors()
            ]);
        }else{

            if($request->edit_exam_id)
            {
                
                $exam_detail=Exam::find($request->edit_exam_id);

                $exam_detail->update([
                    $exam_detail->exam_name=$data['exam_name'],
                    $exam_detail->term=$data['exam_term'],
                    $exam_detail->year=$data['exam_year']
                ]);
                
                $message="Exam details Updated Successfully";

                return response()->json([
                    'status'=>200,
                    'message'=>$message
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
    }

    // get all subject to display into datatable
    public function all_exams(Request $request)
    {
        $allexams=Exam::get();
        
        if($request->ajax()){
            $allexams = DataTables::of ($allexams)
            ->addColumn ('action',function($row){
                return 
                '
                    <a href="#" title="edit exam details" class="btn btn-success editexamdetails" data-id="'.$row->id.'"><i class="fa-solid fa-edit"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);

            return $allexams;
        }
    }

    public function exam($id)
    {
        $exam=Exam::find($id);
        if($exam)
        {
            return response()->json([
                'status'=>200,
                'exam'=>$exam,
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'message'=>'Details Not Found'
            ]);
        }
    }
}
