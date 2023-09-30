<?php

namespace App\Http\Controllers;

use App\Models\Exam_Result;
use App\Models\Grade;
use App\Models\Pupil;
use App\Models\Student_Perfomance;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Admin_Controller extends Controller
{
    public function admin_dashboard()
    {
        $noofteachers=User::where(['role_id'=>2])->count();
        $noofpupils=Pupil::where('grade_id','!=','null')->count();
        $noofexamresults=Exam_Result::count();
        $noofgrades=Grade::where('grade_name','!=','null')->count();
        $latestresults=Student_Perfomance::with(['pupilresultsgrade','pupilresultsname'])->orderBy('id','DESC')->take(4)->get();

        return view('admins.admin_dashboard',compact('noofpupils','noofgrades','noofexamresults','noofteachers','latestresults'));

    }

    // all pupils page
    public function all_classes_page()
    {
        return view('admins.admin_all_grades');
    }

    // get all classes to display into datatable
    public function get_classes(Request $request)
    {
        $allclasses=Grade::get();
        
        if($request->ajax()){
            $allclasses = DataTables::of ($allclasses)

            ->make(true);

            return $allclasses;
        }
    }
}
