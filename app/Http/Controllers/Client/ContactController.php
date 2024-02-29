<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\ContactAdminRequest;
use App\Models\Message;

class ContactController extends DefaultController
{
    public function index()
    {
        parent::__construct();
        return view('pages.client.contact')->with('data', $this->data);
    }
    public function store(ContactAdminRequest $request)
    {
        $model = new Message();
        $email = $request->input('email');
        $name = $request->input('name');
        $subject = $request->input('subject');
        $message = $request->input('message');
        $result = $model->contact($email, $name, $subject, $message);
        if (!$result) {
            return redirect()->back()->with('error', 'An error occurred while sending your message');
        }
        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }

}
