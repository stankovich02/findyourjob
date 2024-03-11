<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Request as RequestFacade;
use App\Traits\LogError;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    protected ?string $currentRoute;

    use LogError;

    public function __construct()
    {
        $this->currentRoute = RequestFacade::route()->getName();
    }
    public function index()
    {
        try {
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
                if ($user->created_at->format('Y-m-d') == $today) {
                    $registrations++;
                }
            }

            $applications = Application::all();
            $applicationsToday = 0;
            foreach ($applications as $application) {
                if ($application->created_at->format('Y-m-d') == $today) {
                    $applicationsToday++;
                }
            }
            return view('pages.admin.dashboard')->with('active', $this->currentRoute)->with('uniqueVisitors',
                $uniqueVisitors)->with('registrations', $registrations)->with('applicationsToday', $applicationsToday);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }

    public function applicationStats()
    {
        try {
            $applications = Application::all();
            $january = 0;
            $february = 0;
            $march = 0;
            $april = 0;
            $may = 0;
            $june = 0;
            $july = 0;
            $august = 0;
            $september = 0;
            $october = 0;
            $november = 0;
            $december = 0;
            foreach ($applications as $application) {
                if ($application->created_at->format('Y') == date('Y')) {
                    $month = $application->created_at->format('m');
                    switch ($month) {
                        case '01':
                            $january++;
                            break;
                        case '02':
                            $february++;
                            break;
                        case '03':
                            $march++;
                            break;
                        case '04':
                            $april++;
                            break;
                        case '05':
                            $may++;
                            break;
                        case '06':
                            $june++;
                            break;
                        case '07':
                            $july++;
                            break;
                        case '08':
                            $august++;
                            break;
                        case '09':
                            $september++;
                            break;
                        case '10':
                            $october++;
                            break;
                        case '11':
                            $november++;
                            break;
                        case '12':
                            $december++;
                            break;
                    }
                }


            }
            $array = [
                'January' => $january,
                'February' => $february,
                'March' => $march,
                'April' => $april,
                'May' => $may,
                'June' => $june,
                'July' => $july,
                'August' => $august,
                'September' => $september,
                'October' => $october,
                'November' => $november,
                'December' => $december
            ];
            return response()->json($array);
        }catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return response()->json(['error' => 'An error occurred.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
