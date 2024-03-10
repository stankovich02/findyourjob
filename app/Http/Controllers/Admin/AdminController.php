<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Request as RequestFacade;

class AdminController extends Controller
{
    protected ?string $currentRoute;

    public function __construct()
    {
        $this->currentRoute = RequestFacade::route()->getName();
    }
    public function index()
    {
        return view('pages.admin.dashboard')->with('active', $this->currentRoute);
    }
}
