<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;

class HomeController extends Controller
{
    public function user_login(Request $request){
        //return $request->all();
        try{
            if(Auth::attempt($request->only('email','password'))){
                $user = Auth::user();
                if($user->deleted_at==1){
                    Auth::logout();
                    $data['result'] = array(
                        'key'=>101,
                        'val'=>'User Inactive Right Now'
                    );
                    return response()->json($data,200);
                }
                $token = $user->createToken('MyApp')->plainTextToken;
                //$data = 'Login Successfull';
                $data['result'] = array(
                    'key'=>200,
                    'email'=>$user->email,
                    'role'=>$user->role,
                    'token'=>$token
                );
                return response()->json($data,200);

            }else{
                $data['result'] = array(
                    'key'=>101,
                    'val'=>'Email and Password Not Matched!'
                );
                return response()->json($data,200);
            }
        }
        catch(Exception $exception){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Internal Server Error!'
            );
            return response()->json($data,200);
        }
    }
    //user register 
    public function user_register(Request $request){
        $user = new User();
        $checkEmail = User::where('email',$request->input('email'))->first();
        if($checkEmail){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Email Already Exists!'
            );
            return response()->json($data,200);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'admin';
        $user->save();
        $token = $user->createToken('MyApp')->plainTextToken;
        //$data = 'Login Successfull';
        Mail::to($user->email)->send(new RegisterMail($user->name));
        $data['result'] = array(
            'key'=>200,
            'email'=>$user->email,
            'role'=>$user->role,
            'token'=>$token
        );
        return response()->json($data,200);

    }
    //get all users
    public function get_users(){
        if(!Auth::check()){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Auth Failed'
            );
            return response()->json($data,200);
        }
        $users = User::where('status',0)->where('is_deleted',0)->orderBy('id','desc')->get();
        $data['result'] = array(
            'key'=>200,
            'val'=>$users
        );
        return response()->json($data,200);
    }
    //
    public function delete($id=NULL){
        if(!Auth::check()){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Auth Failed'
            );
            return response()->json($data,200);
        }
        $user = User::find($id);
        if(!$user){
            $data['result'] = array(
                'key'=>101,
                'val'=>'User Data Not Found'
            );
            return response()->json($data,200); 
        }
        $update = User::where('id',$user->id)->update(['is_deleted'=>1]);
        $data['result'] = array(
            'key'=>200,
            'val'=>'User Data Delete Successfully'
        );
        return response()->json($data,200); 
    }
    //send mail randomly
    public function send_mail(){
        $users = User::where('is_deleted',0)->get();
        foreach($users as $user){
            Mail::to($user->email)->send(new RegisterMail($user->name));
        }
        $data['result'] = array(
            'key'=>200,
            'val'=>'mail send successfully'
        );
        return response()->json($data,200);
    }
}
