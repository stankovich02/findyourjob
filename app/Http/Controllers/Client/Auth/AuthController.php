<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Client\Controller;
use App\Http\Controllers\Client\DefaultController;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthController extends DefaultController
{
    private User $userModel;
    public function __construct()
    {
        $this->userModel = new User();
        parent::__construct();
    }
    public function showRegister() : View
    {
        return view('pages.client.register')->with('data', $this->data);
    }
    public function register(RegisterUserRequest $request) : RedirectResponse
    {
        try {
            $array = [
                'first_name' => $request->input('firstName'),
                'last_name' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            $data = $this->userModel->insert($array);
            Mail::to($request->input('email'))->send(new \App\Mail\EmailVerification($data['token']));
            $this->logUserAction('User registered successfully.', $request, $data['id']);
            return redirect()->back()->with('success', 'You have successfully registered! Please check your email to verify your account.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred');
        }

    }
    public function verify($token) : View|RedirectResponse
    {
        $verified = $this->userModel->verify($token);
        if ($verified) {
            return redirect()->route('home')->with('verified', true);
        }
        return view('mail.verified')->with('message', 'Your account could not be verified!');

    }
    public function showLogin() : View
    {
        return view('pages.client.login')->with('data', $this->data);
    }

    public function login(LoginUserRequest $request) : RedirectResponse
    {
        try{
            $email = $request->input('email');
            $password = $request->input('password');
            $passwordWithEnv = $password . env('CUSTOM_STRING_FOR_HASH');
            $companyModel = new Company();
            if($request->input('accountType') == 'employee')
                $user = $this->userModel::where('email', $email)->first();
            else
                $user = $companyModel::where('email', $email)->first();
            if(!$user || !password_verify($passwordWithEnv, $user->password)){
                $this->logUserAction('User login failed.', $request, $user->id);
                return redirect()->back()->with('error', 'Invalid credentials.');
            }
            if($user->is_active == 0 && $request->input('accountType') == 'employee'){
                $this->logUserAction('User login failed.', $request, $user->id);
                return redirect()->back()->with('error', 'Account is not verified. Please check your email for verification link.');
            }
            if($request->input('accountType') == 'company' && $user->status == $companyModel::STATUS_PENDING){
                $this->logUserAction('Company login failed.', $request, $user->id);
                return redirect()->back()->with('error', 'Your account is pending approval. Please wait for admin to approve your account.');
            }
            $request->session()->put('user', $user);
            $request->session()->put('accountType', $request->input('accountType'));
            if($request->input('accountType') == 'employee'){
                $this->logUserAction('User logged in.', $request, $user->id);
            }
            else{
                $this->logUserAction('Company logged in.', $request, $user->id);
            }
            return redirect()->route('home');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'An error occurred');
        }
    }

    public function logout(Request $request) : RedirectResponse
    {
        try {
            $userID = $request->session()->get('user')->id;
            $accountType = $request->session()->get('accountType');
            $request->session()->forget('user');
            $request->session()->forget('accountType');
            if($accountType == 'employee')
                $this->logUserAction('User logged out.', $request, $userID);
            else
                $this->logUserAction('Company logged out.', $request, $userID);
            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
        }
    }
}
