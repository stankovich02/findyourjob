<?php

namespace App\Http\Controllers\Client;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $userID = $request->session()->get('user')->id;
        if ($request->session()->get("accountType") == "employee") {
            $user = User::with('applications')->find($userID);
            return view('pages.client.account')->with('user', $user);
        }
            $user = Company::find($userID);
            return view('pages.client.account')->with('company', $user);

    }

    public function socials(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'social' => 'required|in:github,linkedin'
        ]);
        $userID = $request->session()->get('user')->id;
        $userModel = new User();
        return $userModel->updateSocials($userID, $request->social, $request->link);
    }
}
