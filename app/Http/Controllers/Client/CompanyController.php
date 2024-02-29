<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\RegisterCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends DefaultController
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $id)
    {
        parent::__construct();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.client.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterCompanyRequest $request)
    {
        $companyModel = new Company();
        $array = [
            'name' => $request->input('companyName'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if ($request->hasFile('logo')) {
            $array['logo'] = $request->file('logo');
        }
        if ($request->input('website')) {
            $array['website'] = $request->input('website');
        }
        if ($request->input('phone')) {
            $array['phone'] = $request->input('phone');
        }
        $companyModel->insert($array);
        return redirect()->back()->with('success', 'You have successfully registered company! Please wait for the admin to verify your account. You will receive an email once your account is verified.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        if(session()->has('user') && session()->get('accountType') == 'company' && session()->get('user')->id == $id){
            return redirect()->route('account');
        }
        $companyModel = new Company();
        $company = $companyModel->getCompany($id);
        return view('pages.client.companies.show')->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
