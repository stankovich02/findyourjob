<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\UpdateAccountPictureRequest;
use App\Http\Requests\UpdateUserDetailsRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AccountController extends DefaultController
{
    private User $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }
    public function index(Request $request) : View
    {
        parent::__construct();
        $userID = $request->session()->get('user')->id;
        if ($request->session()->get("accountType") == "employee") {
            $user = User::with('applications')->find($userID);
            return view('pages.client.account')->with('user', $user)->with('data', $this->data);
        }
            $user = Company::find($userID);
            return view('pages.client.account')->with('company', $user)->with('data', $this->data);

    }

    public function updateSocials(Request $request) : JsonResponse
    {
        try {
            $userID = $request->session()->get('user')->id;
            $this->userModel->updateSocials($userID, $request->social, $request->link);
            return  response()->json(null, ResponseAlias::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json(['errors' => "An error occurred while updating socials"], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function picture(UpdateAccountPictureRequest $request) : RedirectResponse
    {
        try {
            $userID = $request->session()->get('user')->id;
            $this->userModel->updatePicture($userID, $request->picture);
            return redirect()->route('account');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating picture');
        }

    }

    public function info(UpdateUserDetailsRequest $request) : RedirectResponse
    {
        try {
            $userID = $request->session()->get('user')->id;
            return $this->userModel->updateInfo($userID, $request->firstName, $request->lastName, $request->email);
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating info');
        }

    }
}
