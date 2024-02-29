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
        switch ($route){
            case 'home':
                $this->data['active'] = 'home';
                break;
            case 'jobs.index':
                $this->data['active'] = 'jobs.index';
                break;
            case 'about':
                $this->data['active'] = 'about';
                break;
            case 'contact':
                $this->data['active'] = 'contact';
                break;
            case 'author':
                $this->data['active'] = 'author';
                break;
            default:
                $this->data['active'] = '';

        }
        $this->data['nav'] = $navModel->getNav();

    }
}
