<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('pages.client.register');
    }
    public function register(RegisterUserRequest $request)
    {

        $userModel = new User();
        $array = [
            'first_name' => $request->input('firstName'),
            'last_name' => $request->input('lastName'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        $token = $userModel->insert($array);
        Mail::to($request->input('email'))->send(new \App\Mail\EmailVerification($token));
        return redirect()->back()->with('success', 'You have successfully registered! Please check your email to verify your account.');
    }
    public function verify($token)
    {
        $userModel = new User();
        $verified = $userModel->verify($token);
        if ($verified) {
            return redirect()->route('home')->with('verified', true);
        }
        return view('mail.verified')->with('message', 'Your account could not be verified!');

    }
    public function showLogin()
    {
        return view('pages.client.login');
    }

    public function login(LoginUserRequest $request)
    {
        try{
            $email = $request->input('email');
            $password = $request->input('password');
            $passwordWithEnv = $password . env('CUSTOM_STRING_FOR_HASH');
            $userModel = new User();
            $companyModel = new Company();
            if($request->input('accountType') == 'employee')
                $user = $userModel::where('email', $email)->first();
            else
                $user = $companyModel::where('email', $email)->first();
            if(!$user || !password_verify($passwordWithEnv, $user->password)){
                return redirect()->back()->with('error', 'Invalid credentials.');
            }
            if($user->is_active == 0 && $request->input('accountType') == 'employee'){
                return redirect()->back()->with('error', 'Account is not verified. Please check your email for verification link');
            }
            $request->session()->put('user', $user);
            $request->session()->put('accountType', $request->input('accountType'));
            return redirect()->route('home');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->session()->forget('user');
            $request->session()->forget('accountType');
            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
        }
    }
}
