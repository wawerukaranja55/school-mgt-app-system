<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Sign_up_Controller extends Controller
{
    public function user_create_account()
    {
        return view('users.user_auth');
    }

    public function user_sign_up(Request $request){
        $data=$request->all();

        $rules=[
            'phone_number'=>'digits:10'
        ];

        $custommessages=[
            'phone_number.digits:10'=>'The Phone Number Should not be less than 10 digits',
        ];

        $validator = Validator::make( $data,$rules,$custommessages );
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>405,
                'message'=>$validator->errors()
            ]);

        }else{
            $usercount=User::where('email',$data['email_address'])->count();
            if($usercount>0){
                $message="The Account Already Exists for Another User.Check the Email again.";
                return response()->json([
                    'status'=>400,
                    'message'=>$message
                ]);
            }else{
                

                $user=new User;
                $user->name=$data['full_name'];
                $user->email=$data['email_address'];
                $user->role_id='3';
                $user->grade_id='13';
                $user->password=bcrypt($data['password']);
                $user->save();
                
                $message="Welcome to SKaranja School MNGTMNT SYSTEM.Your Account will be Activated in a short while and you will be able to login.";

                return response()->json([
                    'status'=>200,
                    'message'=>$message
                ]);

            }
        } 
    }

    //log in user
    public function user_log_in(Request $request)
    {
        $data=$request->all();

        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            

            $userStatus = Auth::User()->is_approved;
            if($userStatus==1) {
                $message="You have Successfully Logged In To Your Account";
                return response()->json([
                    'status'=>201,
                    'message'=>$message
                ]);
            }else{
                Auth::logout();
                $message="Your Account hasnt been Activated.Please contact the admin to activate";
                return response()->json([
                    'status'=>500,
                    'message'=>$message
                ]);
            }
        }
        else {

            $message="Invalid Email or Password";
            return response()->json([
                'status'=>405,
                'message'=>$message
            ]);
        }
    
    }

    public function user_log_out(Request $request){
        Auth::logout();
        return redirect('/');
    }

    public function user_forgot_password(Request $request){
        $data=$request->all();

        $emailcount=User::where('email',$data['email'])->count();

        if($emailcount>0)
        {
            $random_password= Str::random(8);
            $new_password=bcrypt($random_password);

            $new_password=bcrypt($random_password);

            User::where('email',$data['email'])->update(['password'=>$new_password]);
            $username=User::select('name')->where('email',$data['email'])->first();

            $email=$data['email'];
            $name=$username->name;
            $messagedata=['email'=>$email,'name'=>$name,'password'=>$random_password];

            Mail::send('emails.forgotpass', $messagedata, function ($message) use($email) {
                $message->to($email)->subject('New Password for your Account');
            });

            $message="Please check your email for new password";
            return response()->json([
                'status'=>201,
                'message'=>$message
            ]);
            
        } else {
            $message="Email Doesn't Exists";
            return response()->json([
                'status'=>404,
                'message'=>$message
            ]);
        }
    }
}
