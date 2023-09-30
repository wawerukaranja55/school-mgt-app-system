<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Pupil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Student_Perfomance;

class Pupil_Controller extends Controller
{
    // all pupils page
    public function all_pupils_page()
    {
        return view('admins.admin_all_pupils');
    }

    // get all pupils to display into datatable
    public function get_pupils(Request $request)
    {
        $allpupils=Pupil::with('pupilgrade')->select('id','pupil_name','pupil_guardian_name','year_joined','grade_id','pupil_guardian_phone','pupil_reg_number');
        
        if($request->ajax()){
            $allpupils = DataTables::of ($allpupils)

            ->addColumn ('grade_id',function(Pupil $pupil){
                return $pupil->pupilgrade->grade_name;
            })

            ->addColumn ('action',function($row){
                return 
                '
                    <a href="#" title="edit pupil details" class="btn btn-success editpupildetails" data-id="'.$row->id.'"><i class="fa-solid fa-edit"></i></a>
                ';
            })
            ->rawColumns(['grade_id','action'])
            ->make(true);

            return $allpupils;
        }
    }

    // add new details for a pupil page
    public function create_new_pupil_page()
    {
        $all_grades=Grade::get();
        
        return view('admins.admin_add_pupil',compact('all_grades'));
    }

    //store pupil details 
    public function create_new_pupil(Request $request)
    {
        $data=$request->all();
        
        $rules=[
            'pupil_name'=>'min:3',
            'pupil_guardian_phone'=>'digits:10',
            'pupil_guardian_name'=>'min:3',
            'year_joined'=>'required'
        ];

        $custommessages=[
            'pupil_name.min:3'=>'The pupil name should greater than 3 letters',
            'year_joined.required'=>'kindly select the date the pupil joined',
            'pupil_guardian_name.min:3'=>'The pupil guardian name should greater than 3 letters',
            'pupil_guardian_phone.digits:10'=>'The phone number should be 10 numbers'
        ];

        $validator = Validator::make( $data,$rules,$custommessages );
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>405,
                'message'=>$validator->errors()
            ]);
        }else{

            if($request->edit_pupil_id)
            {
                
                $pupil_details=Pupil::find($request->edit_pupil_id);

                $pupil_details->update([
                    $pupil_details->pupil_name=$data['pupil_name'],
                    $pupil_details->pupil_guardian_name=$data['pupil_guardian_name'],
                    $pupil_details->pupil_guardian_phone=$data['pupil_guardian_phone'],
                    $pupil_details->pupil_reg_number=$data['pupil_reg_number'],
                    $pupil_details->year_joined=$data['year_joined'],
                    $pupil_details->grade_id=$data['grad_id']
                ]);
                
                $message="Pupil data Updated Successfully";

                return response()->json([
                    'status'=>200,
                    'message'=>$message
                ]);
            }else{

                $pupilcount=Pupil::where('pupil_reg_number',$data['pupil_reg_number'])->count();
                if($pupilcount>0){
                    $message="The Registration is regstered for Another Pupil.Kindly Check the it again.";
                    return response()->json([
                        'status'=>400,
                        'message'=>$message
                    ]);
                }else{

                    $pupil=new Pupil();
                    $pupil->pupil_name=$data['pupil_name'];
                    $pupil->pupil_guardian_name=$data['pupil_guardian_name'];
                    $pupil->pupil_guardian_phone=$data['pupil_guardian_phone'];
                    $pupil->pupil_reg_number=$data['pupil_reg_number'];
                    $pupil->year_joined=$data['year_joined'];
                    $pupil->grade_id=$data['grad_id'];
                    $pupil->save();

                    $message="Pupil data registered Successfully";

                    return response()->json([
                        'status'=>200,
                        'message'=>$message
                    ]);
                }
            }
            
        }
    }

    //store pupil details 
    public function graduate_pupil(Request $request)
    {
        $data=$request->all();
        
        $pupil_details=Pupil::find($request->edit_pupil_id);

        $pupil_details->update([
            $pupil_details->grade_id=$data['pupilgrade']
        ]);

        $pupildetailsupdate=Student_Perfomance::where(['pupil_id'=>$request->edit_pupil_id,'term'=>$request->pupil_term,'year'=>$request->pupil_year])->first();

        $pupildetailsupdate->update([
            $pupildetailsupdate->class_id=$data['pupilgrade']
        ]);
        
        $message="Pupil Graduated to the next class Successfully";

        return response()->json([
            'status'=>200,
            'message'=>$message
        ]);
    }

    public function get_pupil_details($id)
    {
        $editpupildetails=Pupil::find($id);
        if($editpupildetails)
        {
            return response()->json([
                'status'=>200,
                'editpupildetails'=>$editpupildetails,
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'message'=>'Details Not Found'
            ]);
        }
    }

    public function get_pupil_grade($id)
    {
        $pupil_grade=Pupil::with('pupilgrade')->find($id);
        if($pupil_grade)
        {
            return response()->json([
                'status'=>200,
                'pupil_grade'=>$pupil_grade,
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'message'=>'Details Not Found'
            ]);
        }
    }
}
