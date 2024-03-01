<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\RegisterCompanyRequest;
use App\Http\Requests\UpdateComapnyDetailsRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends DefaultController
{
    private Company $companyModel;
    public function __construct()
    {
        parent::__construct();
        $this->companyModel = new Company();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(int $id)
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('pages.client.companies.create')->with('data', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterCompanyRequest $request) : string
    {
        $array = [
            'name' => $request->input('companyName'),
            'cities' => $request->input('cities'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if ($request->input('website')) {
            $array['website'] = $request->input('website');
        }
        if ($request->input('phone')) {
            $array['phone'] = $request->input('phone');
        }
        return $this->companyModel->insert($array);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) : View|RedirectResponse
    {
        parent::__construct();
        if(session()->has('user') && session()->get('accountType') == 'company' && session()->get('user')->id == $id){
            return redirect()->route('account');
        }
        $company = $this->companyModel->getCompany($id);
        return view('pages.client.companies.show')->with('company', $company)->with('data', $this->data);
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
    public function update(UpdateComapnyDetailsRequest $request, int $id) : RedirectResponse
    {
        return $this->companyModel->updateCompany($id, $request->input('companyName'), $request->input('description'),
        $request->input('email'), $request->input('website'), $request->input('phone'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


    }
}
