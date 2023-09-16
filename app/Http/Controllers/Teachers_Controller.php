<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Grade;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Teachers_Controller extends Controller
{
    // all pupils page
    public function all_teachers_page()
    {
        return view('admins.admin_all_teachers');
    }

    // get all pupils to display into datatable
    public function get_teachers(Request $request)
    {
        $allteachers=User::with(['classes','roles'])->select('id','name','email','is_approved','grade_id','role_id');
        
        if($request->ajax()){
            $allteachers = DataTables::of ($allteachers)

            // ->addColumn ('grade_id',function(User $user){
            //     return $user->classes->grade_name;
            // })
            // ->rawColumns(['grade_id'])
            ->make(true);

            return $allteachers;
        }
    }

    // get data into a modal
    public function get_teacher_class($id)
    {
        $teacherdata=User::with('classes')->find($id);
        // $adminrole=$admindata->roles;
        if($teacherdata)
        {
            return response()->json([
                'status'=>200,
                'teacherdata'=>$teacherdata
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'message'=>'Teacher Not Found'
            ]);
        }
    }

    /**
     * assign admin another role
     */
    public function assign_class(Request $request)
    {
        $gradetitle=Grade::where('id',$request->selectedgrade)->pluck('grade_name');

        $grdtitle=$gradetitle[0];
        $user=User::find($request->teachergrade_id);
        $user->is_approved=1;
        $user->role_id=2;
        $user->grade_id=$request->selectedgrade;
        $user->save();

        return response()->json([
            'status'=>200,
            'message'=>'User has been assigned '.$grdtitle.' changed successfully'
        ]);
    }
}
