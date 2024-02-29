<?php

namespace App\Http\Controllers\Client;

use App\Models\User;

class DefaultController extends Controller
{
    protected array $data;
    public function __construct()
    {
        if(session()->has('user')) {
            $this->data['user'] = User::find(session()->get('user')->id);
        }
    }
}
