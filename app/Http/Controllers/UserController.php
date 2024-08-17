<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function userRegistration(Request $request){

        try{
            User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User registration successfully done'
            ], 201);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'User registration fail'
            ]);
        }
    }


    public function userLogin(Request $request){
        $count = User::where('email', '=', $request->input('email'))
        ->where('password', '=', $request->input('password'))->select('id')->first();

        if($count !== null){
            // user login
            $token = JWTToken::createToken($request->input('email'), $count->id);

            return response()->json([
                'status' => 'success',
                'message' => 'You are logged in successfully',
                'token' => $token
            ])->cookie('token',$token,60*24*30);

        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Login fail',
            ]);
        }
    }


    public function sendOTPToEmail(Request $request){
        $email = $request->input('email');
        $otp = rand('000000', '999999');

        $count = User::where('email', '=', $email)->count();

        if($count == 1){
            // Sent OTP vto email
            // Mail::to($email)->send(new OTPMail($otp));

            // Update OTP in database 
            User::where('email', '=', $email)->update(['otp'=>$otp]);

            return response()->json([
                'status' => 'success',
                'message' => 'OTP has been sent successfully',
                'otp' => $otp
            ], 201);

        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Unauthorized user'
            ]);
        }

    }


    public function verifyOTP(Request $request){
        $email = $request->input('email');
        $otp = $request->input('otp');

        $count = User::where('email', '=', $email)->where('otp', '=', $otp)->count();

        if($count == 1){
            // Update OTP in database
            User::where('email', '=', $email)->update(['otp'=>'1']);

            // Create token for password
            $token = JWTToken::createTokenForPassword($email);

            return response()->json([
                'status' => 'success',
                'message' => 'Otp varified successfully',
                'token' => $token
            ])->cookie('token',$token,60*24*30);


        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Unauthorized user'
            ]);
        }
    }


    public function resetPassword(Request $request){
        try{
            $email = $request->header('email');
            $password = $request->input('password');

            User::where('email', '=', $email)->update(['password'=>$password]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password has been reset successfully'    
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'    
            ]);
        }
    }



    public function logoutAction(Request $request){
            return redirect('/')->cookie('token', '', -1);
        }



    public function userProfileAction(Request $request){
        try{
            $email = $request->header('email');

            $data = User::where('email', '=', $email)->first();

            return response()->json([
                'status' => 'success',
                'message' => 'Request successfull',
                'data' => $data
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'
            ]);
        }
    }
    public function userProfileUpdate(Request $request){
        try{
            $email = $request->header('email');

             User::where('email', '=', $email)->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);           

            return response()->json([
                'status' => 'success',
                'message' => 'Profile info updated successfull',
                
            ], 201);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail to update profile info'
            ], 401);
        }
    } 





} 
