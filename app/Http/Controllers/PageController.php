<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function registrationPage(Request $request){
        return view('pages.auth.registration');
    }

    public function loginPage(Request $request){
        return view('pages.auth.login-page');
    }

    public function sendOTPPage(Request $request){
        return view('pages.auth.send-otp-page');
    }


    public function verifyOTPPage(Request $request){
        return view('pages.auth.verify-otp-page');
    }

    public function resetPasswordPage(Request $request){
        return view('pages.auth.password-reset-page');
    }

    public function dashboardPage(Request $request){
        return view('pages.dashboard.summery-page');
    }

    public function userProfilePage(Request $request){
        return view('pages.dashboard.profile-page');
    }

    public function landingPage(Request $request){
        return view('pages.landing-page');
    }



    


}
