<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserActionLog;

class UserActionController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        try {
            $date = \request()->get('date');
            if($date){
                $userActions = UserActionLog::whereDate('created_at', $date)->paginate(10)->withQueryString();
            }else{
                $userActions = UserActionLog::paginate(10)->withQueryString();
            }
            return view('pages.admin.user-actions.index')->with('userActions', $userActions)->with('active',
                $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred.');
        }
    }
}
