<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\UpdateAccountPictureRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AccountController extends DefaultController
{
    public function index(Request $request) : \Illuminate\View\View
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

    public function socials(Request $request) : JsonResponse
    {
        dd($request->all());
        $userID = $request->session()->get('user')->id;
        $userModel = new User();
        return $userModel->updateSocials($userID, $request->social, $request->link);
    }

    public function picture(UpdateAccountPictureRequest $request) : RedirectResponse
    {
        $userID = $request->session()->get('user')->id;
        $accType = $request->session()->get('accountType');
        $userModel = new User();
        return $userModel->updatePicture($userID, $request->picture, $accType);
    }
}
