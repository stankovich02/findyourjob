<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;
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
        $today = date('Y-m-d');
        $accessLogs = \Storage::get('logs/AccessLog.txt');
        $visitors = [];
        foreach (explode("\r\n", $accessLogs) as $line) {
            $parts = explode(' ', $line);
            if (count($parts) >= 3) {
                $date = $parts[0];
                $ip = $parts[2];
                if ($date == $today) {
                    if (!in_array($ip, $visitors)) {
                        $visitors[] = $ip;
                    }
                }
            }
        }
        $uniqueVisitors = count($visitors);

        $users = User::all();
        $registrations = 0;
        foreach ($users as $user) {
            if ($user->created_at->format('Y-m-d') == $today){
                $registrations++;
            }
        }
        return view('pages.admin.dashboard')->with('active', $this->currentRoute)->with('uniqueVisitors',
                $uniqueVisitors)->with('registrations', $registrations);
    }
}
