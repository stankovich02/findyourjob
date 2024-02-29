<?php

namespace App\Http\Controllers\Client;

use App\Models\Company;
use App\Models\User;

class DefaultController extends Controller
{
    protected array $data;
    public function __construct()
    {
        if(session()->has('user')) {
            if(session()->get('accountType') == 'employee')
                $this->data['user'] = User::with('applications')->find(session()->get('user')->id);
            else
                $this->data['user'] = Company::find(session()->get('user')->id);
        }
        else {
            $this->data['user'] = null;
        }
    }
}
