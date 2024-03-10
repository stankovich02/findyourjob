<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\ContactAdminRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class
ContactController extends DefaultController
{
    public function index() : View|RedirectResponse
    {
        parent::__construct();
        if(session()->has('user') && session()->get('user')->isAdmin) {
           return redirect()->route('home');
        }
        return view('pages.client.contact')->with('data', $this->data);
    }
    public function store(ContactAdminRequest $request) : RedirectResponse
    {
        try {
            $email = $request->input('email');
            $name = $request->input('name');
            $subject = $request->input('subject');
            $content = $request->input('message');
            $admins = User::where('role_id', 2)->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new \App\Mail\ContactAdmin($name, $email, $subject, $content));
            }
            return redirect()->back()->with('success', 'Your message has been sent successfully.');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }
}
