<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class Subject_Controller extends Controller
{
    // all pupils page
    public function all_subjects_page()
    {
        return view('admins.admin_all_subjects');
    }

    // add new details for a pupil page
    public function create_new_subject_page()
    {
        $gradesarray=Grade::get();
        $all_teachers=User::with('roles')->where('role_id',2)->get();
        return view('admins.admin_add_subject',compact(['gradesarray','all_teachers']));
    }

    // get all subject to display into datatable
    public function all_subjects(Request $request)
    {
        $allsubjects=Subject::select('id','subject_name');
        
        if($request->ajax()){
            $allsubjects = DataTables::of ($allsubjects)
            ->make(true);

            return $allsubjects;
        }
    }

    //store subject details 
    public function create_new_subject(Request $request)
    {
        $data=$request->all();
        

        $rules=[
            'subject_name'=>'min:3'
        ];

        $custommessages=[
            'subject_name.min:3'=>'The subject name should greater than 3 letters'
        ];

        $validator = Validator::make( $data,$rules,$custommessages );
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>405,
                'message'=>$validator->errors()
            ]);
        }else{

            $subjectcount=Subject::where('subject_name',$data['subject_name'])->count();
            if($subjectcount>0){
                $message="The Subject name already exists.Kindly Check the it again.";
                return response()->json([
                    'status'=>400,
                    'message'=>$message
                ]);
            }else{

                $subject=new Subject();
                $subject->subject_name=$data['subject_name'];
                $subject->subject_teacher_id=$data['teacher_id'];
                $subject->save();

                $subject->subjectgrades()->attach(request('grades'));

                $message="Subject registered Successfully";

                return response()->json([
                    'status'=>200,
                    'message'=>$message
                ]);
            }
        }
    }

}
