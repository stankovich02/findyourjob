<?php

namespace App\Http\Controllers\Client;

use App\Models\Company;
use App\Models\Nav;
use App\Models\User;
use Request;

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
        $navModel = new Nav();
        $route = Request::route()->getName();
        $this->data['active'] = match ($route) {
            'home' => 'home',
            'jobs.index' => 'jobs.index',
            'about' => 'about',
            'contact' => 'contact',
            'author' => 'author',
            default => '',
        };
        $this->data['nav'] = $navModel->getNav();

    }
}
