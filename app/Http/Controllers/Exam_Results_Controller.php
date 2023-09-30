<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Exam_pupil_Pivot;
use App\Models\Exam_Result;
use App\Models\Grade;
use App\Models\Pupil;
use App\Models\Student_Perfomance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class Exam_Results_Controller extends Controller
{
    // all pupils page
    public function all_results_page()
    {
        return view('admins.admin_all_examsresults');
    }

    // get all exam results to display into datatable
    public function all_results(Request $request)
    {
        $allexamresults=Exam_Result::with(['pupilname','pupilexam','studentgrade'])->get();
        
        if($request->ajax()){
            $allexamresults = DataTables::of ($allexamresults)

            ->addColumn ('student_id',function(Exam_Result $exam_result){
                return $exam_result->pupilname->pupil_name;
            })

            ->addColumn ('exam_id',function(Exam_Result $exam_result){
                return $exam_result->pupilexam->exam_name;
            })

            ->addColumn ('class_id',function(Exam_Result $exam_result){
                return $exam_result->studentgrade->grade_name;
            })

            ->addColumn ('action',function($row){
                return
                '   <a href="/admin/view_pupil_results/'.$row->pupilname->id.'/'.$row->pupilexam->id.'" target="_blank" title="View Pupil Results"  class="btn btn-primary viewpupilresults" data-id="'.$row->id.'"><i class="fa-solid fa-eye"></i></a>

                    <a href="#" title="edit pupil details" class="btn btn-success editpupilresults" data-id="'.$row->id.'"><i class="fa-solid fa-edit"></i></a>

                    <a href="/admin/download_pupil_results/'.$row->pupilname->id.'/'.$row->pupilexam->id.'" target="_blank" title="Download Pupil Results"  class="btn btn-danger downloadpupildetails" data-id="'.$row->id.'"><i class="fa-solid fa-download"></i></a>
                ';
            })
            ->rawColumns(['class_id','student_id','exam_id','action'])
            ->make(true);

            return $allexamresults;
        }
    }


    // add new details for a pupil page
    public function create_exams_results_page()
    {
        $unfilledexams=Exam::get();

        $unfilledgrades=Grade::get();

        return view('admins.create_exams_results_page',compact('unfilledexams','unfilledgrades'));
    }

    public function find_class(Request $request)
    {
        $data=$request->all();

        $rules=[
            'exam_results'=>'required'
        ];

        $custommessages=[
            'exam_results.required'=>'kindly select the name of exam to add results'
        ];

        $validator = Validator::make( $data,$rules,$custommessages );

        if($validator->fails())
        {
            return response()->json([
                'status'=>405,
                'message'=>$validator->errors()
            ]);
        }else{

            $resultscount=Exam_Result::where(['exam_id'=>$data['exam_results'],'class_id'=>$data['class_results_id']])->count();

            if($resultscount>0){
                $totalNoOfPupils=Pupil::where(['grade_id'=>$data['class_results_id']])->count();

                $totalSavedResultsPupils = Exam_Result::where(['exam_id'=>$data['exam_results'],'class_id'=>$data['class_results_id']])->count();

                if($totalSavedResultsPupils !== $totalNoOfPupils)
                {
                    //first check if there are uncomplete results for that class 
                    $savedResultsPupilIds = Exam_Result::where(['exam_id'=>$data['exam_results'],'class_id'=>$data['class_results_id']])->pluck('student_id')->all();
                    $pupilsToAddResults = Pupil::whereNotIn('id', $savedResultsPupilIds)->where(['grade_id'=>$data['class_results_id']])->select(['pupil_name','id','grade_id'])->get();
                    $examnme=Exam::where(['id'=>$data['exam_results']])->get(['exam_name','id','term']);
                    $message="Add Exam Results for these pupils to add results for the whole class";
                    return response()->json([
                        'status'=>400,
                        'message'=>$message,
                        'pupilsToAddResults'=>$pupilsToAddResults,
                        'examnme'=>$examnme
                    ]);
                }else{

                    $message="Exam Results for the class already exist for that exam";

                    return response()->json([
                        'status'=>420,
                        'message'=>$message,
                    ]);
                }
                
            }else{
                $message="Add exam results for the students for that class";
                // get pupils for the class
                $pupildetails=Pupil::where(['grade_id'=>$data['class_results_id']])->get(['pupil_name','id','grade_id']);
                $examnme=Exam::where(['id'=>$data['exam_results']])->get(['exam_name','id','term']);
                return response()->json([
                    'status'=>200,
                    'message'=>$message,
                    'pupildetails'=>$pupildetails,
                    'examnme'=>$examnme
                ]);
            }
        }
    }

    //store subject details 
    public function create_results(Request $request)
    {
        $data=$request->all();

        $rules=[
            'maths'=>'required|numeric|min:1|max:100',
            'eng'=>'required|numeric|min:1|max:100',
            'kiswa'=>'required|numeric|min:1|max:100',
            'home_sci'=>'required|numeric|min:1|max:100',
            'science'=>'required|numeric|min:1|max:100',
            'cre'=>'required|numeric|min:1|max:100',
            'social_stud'=>'required|numeric|min:1|max:100'
        ];

        $custommessages=[
            'maths.required'=>'Kindly write the total maths marks for the pupil',
            'maths.numeric'=>'The maths should be a number',
            'maths.min:1'=>'The total marks should not be less than 1',
            'maths.max:100'=>'The total marks should not be greater than 100',

            'eng.required'=>'Kindly write the total English marks for the pupil',
            'eng.numeric'=>'The English should be a number',
            'eng.min:1'=>'The total marks should not be less than 1',
            'eng.max:100'=>'The total marks should not be greater than 100',

            'kiswa.required'=>'Kindly write the total Kiswahili marks for the pupil',
            'kiswa.numeric'=>'The Kiswahili should be a number',
            'kiswa.min:1'=>'The total marks should not be less than 1',
            'kiswa.max:100'=>'The total marks should not be greater than 100',

            'home_sci.required'=>'Kindly write the total Home Science marks for the pupil',
            'home_sci.numeric'=>'The Home Science should be a number',
            'home_sci.min:1'=>'The total marks should not be less than 1',
            'home_sci.max:100'=>'The total marks should not be greater than 100',

            'science.required'=>'Kindly write the total Science marks for the pupil',
            'science.numeric'=>'The Science should be a number',
            'science.min:1'=>'The total marks should not be less than 1',
            'science.max:100'=>'The total marks should not be greater than 100',

            'cre.required'=>'Kindly write the total CRE marks for the pupil',
            'cre.numeric'=>'The CRE should be a number',
            'cre.min:1'=>'The total marks should not be less than 1',
            'cre.max:100'=>'The total marks should not be greater than 100',

            'social_stud.required'=>'Kindly write the total social studie marks for the pupil',
            'social_stud.numeric'=>'The social studies should be a number',
            'social_stud.min:1'=>'The total marks should not be less than 1',
            'social_stud.max:100'=>'The total marks should not be greater than 100',
        ];

        $validator = Validator::make( $data,$rules,$custommessages );
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>405,
                'message'=>$validator->errors()
            ]);
        }else{

            if($request->results_id)
            {
                
                $exam_results=Exam_Result::find($request->results_id);

                $exam_results->update([
                    $exam_results->class_id=$data['class_id'],
                    $exam_results->exam_id=$data['exam_id'],
                    $exam_results->student_id=$data['pupil_id'],
                    $exam_results->maths=$data['maths'],
                    $exam_results->cre=$data['cre'],
                    $exam_results->sci=$data['science'],
                    $exam_results->eng=$data['eng'],
                    $exam_results->kiswa=$data['kiswa'],
                    $exam_results->social_stud=$data['social_stud'],
                    $exam_results->home_sci=$data['home_sci'],

                    $examyear=Exam::where('id',$data['exam_id'])->pluck('year'),

                    $totalmarks=array_sum([$data['maths'],$data['cre'],$data['science'],$data['eng'],$data['kiswa'],$data['social_stud'],$data['home_sci']]),

                    $average = $totalmarks / count([$data['maths'],$data['cre'],$data['science'],$data['eng'],$data['kiswa'],$data['social_stud'],$data['home_sci']]),
                    
                    $finalavg=round($average, 2),

                    $exam_results->total_marks=$totalmarks,

                    $exam_results->mean=$finalavg,

                    $exam_results->year=$examyear[0],

                    $exam_results->term=$data['term']
                ]);
                
                $message="Exam Results Updated Successfully";

                return response()->json([
                    'status'=>200,
                    'message'=>$message,
                    'pupilid'=>$data['pupil_id']
                ]);
            }else{

                $examcount=Exam_Result::where(['exam_id'=>$data['exam_id'],'student_id'=>$data['pupil_id']])->count();
                if($examcount>0){
                    $message="The Exam results for the pupil already exists.Kindly Check again.";
                    return response()->json([
                        'status'=>400,
                        'message'=>$message
                    ]);
                }else{

                    $exam_results=new Exam_Result();
                    $exam_results->class_id=$data['class_id'];
                    $exam_results->exam_id=$data['exam_id'];
                    $exam_results->student_id=$data['pupil_id'];
                    $exam_results->maths=$data['maths'];
                    $exam_results->cre=$data['cre'];
                    $exam_results->sci=$data['science'];
                    $exam_results->eng=$data['eng'];
                    $exam_results->kiswa=$data['kiswa'];
                    $exam_results->social_stud=$data['social_stud'];
                    $exam_results->home_sci=$data['home_sci'];

                    $examyear=Exam::where('id',$data['exam_id'])->pluck('year');

                    $totalmarks=array_sum([$data['maths'],$data['cre'],$data['science'],$data['eng'],$data['kiswa'],$data['social_stud'],$data['home_sci']]);

                    $average = $totalmarks / count([$data['maths'],$data['cre'],$data['science'],$data['eng'],$data['kiswa'],$data['social_stud'],$data['home_sci']]);
                    
                    $finalavg=round($average, 2);

                    $exam_results->total_marks=$totalmarks;

                    $exam_results->mean=$finalavg;

                    $exam_results->year=$examyear[0];

                    $exam_results->term=$data['term'];

                    $exam_results->save();

                    //check if there are previous means for the student
                    $perfomance_count=Student_Perfomance::where(['pupil_id'=>$data['pupil_id'],'term'=>$data['term'],'year'=>$examyear[0]])->count();
                    
                    if($perfomance_count>0){
                        $exam_means=Exam_Result::where(['student_id'=>$data['pupil_id'],'term'=>$data['term'],'year'=>$examyear[0]])->pluck('mean')->toArray();
 
                        $finalmean=array_sum($exam_means);

                        $examdonecount=Exam_Result::where(['student_id'=>$data['pupil_id'],'term'=>$data['term'],'year'=>$examyear[0]])->count();

                        $avgTermMean=$finalmean/$examdonecount;

                        $pupilperfomanceupdate=Student_Perfomance::where(['pupil_id'=>$data['pupil_id'],'term'=>$data['term'],'year'=>$examyear[0]])->first();

                        $pupilperfomanceupdate->update([
                            $pupilperfomanceupdate->mean=$avgTermMean,
                        ]);

                    }else{
                        $student_perfomance=new Student_Perfomance();
                        $student_perfomance->pupil_id=$data['pupil_id'];
                        $student_perfomance->class_id=$data['class_id'];
                        $student_perfomance->term=$data['term'];
                        $student_perfomance->year=$examyear[0];
                        $student_perfomance->mean=$finalavg;
                        $student_perfomance->save();
                    }
                    //if exists,add the total mean n the latest then divide by no of exams
                    // if doesnt create new one


                    $message="Exam Results Saved Successfully";

                    return response()->json([
                        'status'=>200,
                        'message'=>$message,
                        'pupilid'=>$data['pupil_id']
                    ]);
                }
            }
        }
    }

    public function get_pupil_results($id)
    {
        $editpupilresults=Exam_Result::find($id);
        $termAndYear=$editpupilresults->get(['student_id','exam_id']);
        $termyear=Exam::where('id',$termAndYear[0]->exam_id)->get(['year','term']);
        
        if($editpupilresults)
        {
            return response()->json([
                'status'=>200,
                'editpupilresults'=>$editpupilresults,
                'termyear'=>$termyear
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'message'=>'Results Not Found'
            ]);
        }
    }
}
