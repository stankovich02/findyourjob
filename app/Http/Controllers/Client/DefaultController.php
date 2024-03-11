<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Nav;
use App\Models\User;
use App\Models\UserActionLog;
use App\Traits\LogError;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Request as RequestFacade;

class DefaultController extends Controller
{
    use LogError;
    protected array $data = [];

    public function __construct()
    {
        if (session()->has('user')) {
            if (session()->get('accountType') == 'employee') {
                $this->data['user'] = User::with('applications')->find(session()->get('user')->id);
            } else {
                $this->data['user'] = Company::find(session()->get('user')->id);
            }
        } else {
            $this->data['user'] = null;
        }

        $navModel = new Nav();
        $route = RequestFacade::route()->getName();
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

    protected function logUserAction(string $action, Request $request, $user_id = null) : void
    {
        try {
            $userActionLog = new UserActionLog();
            $user_id = $request->session()->has('user') ? $request->session()->get('user')->id : $user_id;
            $userActionLog->insert($request->ip(), $request->path(), $request->method(), $user_id, $action);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
