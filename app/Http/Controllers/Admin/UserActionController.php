<?php

namespace App\Http\Controllers\Admin;

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
            $dateFrom = \request()->get('dateFrom');
            $dateTo = \request()->get('dateTo');
            $userActions = UserActionLog::query();
            if($dateFrom){
                $userActions->where('created_at', '>=', $dateFrom);
            }
            if($dateTo){
                $userActions->where('created_at', '<=', $dateTo);
            }
            $userActions = $userActions->paginate(10)->withQueryString();
            return view('pages.admin.user-actions.index')->with('userActions', $userActions)->with('active',
                $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred.');
        }
    }
}
