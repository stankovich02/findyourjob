<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateUserDetailsRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AccountController extends DefaultController
{
    public function __construct(private readonly User $userModel = new User(), private readonly Company $companyModel =
    new Company())
    {
        parent::__construct();
    }
    public function index(Request $request) : View|RedirectResponse
    {
        parent::__construct();
        try {
            if(session()->get('user')->isAdmin){
                return redirect()->route('admin.index');
            }
            $userID = $request->session()->get('user')->id;
            if (!$request->session()->get("user")->isCompany) {
                $user = User::with('applications')->find($userID);
                return view('pages.client.account')->with('user', $user)->with('data', $this->data);
            }
            $user = Company::find($userID);
            return view('pages.client.account')->with('company', $user)->with('data', $this->data);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }

    }

    public function updateSocials(Request $request) : JsonResponse
    {
        try {
            $userID = $request->session()->get('user')->id;
            $this->userModel->updateSocials($userID, $request->social, $request->link);
            return  response()->json(null, ResponseAlias::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return response()->json(['errors' => "An error occurred while updating socials"], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function picture(Request $request) : RedirectResponse
    {
        try {
            $userID = $request->session()->get('user')->id;
            $this->userModel->updatePicture($userID, $request->picture);
            return redirect()->route('account.index');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }

    }

    public function info(UpdateUserDetailsRequest $request) : RedirectResponse
    {
        try {
            $userID = $request->session()->get('user')->id;
            return $this->userModel->updateInfo($userID, $request->firstName, $request->lastName, $request->email);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }

    public function showFormForNewPassword() : View
    {
        parent::__construct();
        return view('pages.client.update-password')->with('data', $this->data);
    }
    public function updatePassword(ChangePasswordRequest $request) : RedirectResponse
    {
        try {
            $userID = $request->session()->get('user')->id;
            if ($request->session()->get("user")->isCompany) {
                $result = $this->companyModel->updatePassword($userID, $request->currentPassword, $request->newPassword);
            }
            else{
                $result = $this->userModel->updatePassword($userID, $request->currentPassword, $request->newPassword);
            }
            if ($result) {
                if($request->session()->get("user")->isCompany)
                    $this->logUserAction('Company has updated the password.', $request);
                else
                    $this->logUserAction('User has updated the password.', $request);
                $request->session()->forget('user');
                return redirect()->route('login')->with('success', 'Password updated successfully. Please login again.');
            }
            return redirect()->back()->with('currentPassword', 'Current password is incorrect.');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }

    public function showFormForEmail() : View
    {
        return view('pages.client.forgot-password')->with('data', $this->data);
    }
    public function sendEmailForReset(Request $request) : RedirectResponse
    {
        try {
            $email = $request->input('email');
            $user = $this->userModel::where('email', $email)->first();
            if(!$user){
                return redirect()->back()->with('error', 'No user found with this email.');
            }
            if($user->is_active == 0){
                return redirect()->back()->with('error', 'Please verify your email first.');
            }
            if($user->token != null){
                return redirect()->back()->with('error', 'We have already sent you an email for reset password. Please check your email.');
            }
            $token = $user->getTokenForReset();
            Mail::to($email)->send(new \App\Mail\ResetPassword($token));
            return redirect()->back()->with('success', 'Please check your email for reset password link.');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }
    public function showFormForReset($token) : View
    {
        return view('pages.client.reset-password')->with('data', $this->data)->with('token', $token);
    }
    public function resetPassword(ResetPasswordRequest $request, $token) : RedirectResponse
    {
        try {
            $password = $request->input('password');
            $id = $this->userModel->resetPassword($token, $password);
            if(!$id){
                return redirect()->back()->with('error', 'Invalid token.');
            }
            $this->logUserAction('User has reset the password.', $request, $id);
            return redirect()->route('login')->with('success', 'Password has been successfully reset.');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }
}
