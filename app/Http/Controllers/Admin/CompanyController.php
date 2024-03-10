<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CompanyJobStatusMail;
use App\Mail\CompanyStatusMail;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CompanyController extends AdminController
{
    public function __construct(private readonly Company $companyModel = new Company())
    {
        parent::__construct();
    }
    public function index() : View
    {
        $companies = $this->companyModel::where('status', $this->companyModel::STATUS_ACTIVE)->paginate(5);
        return view('pages.admin.companies.index')->with('companies', $companies)->with('active', $this->currentRoute);
    }

    public function pending() : View
    {
        $companies = $this->companyModel::where('status', $this->companyModel::STATUS_PENDING)->paginate(5);
        return view('pages.admin.companies.pending')->with('companies', $companies)->with('active',
            $this->currentRoute);
    }
    public function approve(int $id) : RedirectResponse
    {
        $data = $this->companyModel->approve($id);
        Mail::to($data['email'])->send(new CompanyStatusMail('approved', $data['name']));
        return redirect()->route('admin.companies.index')->with('success', 'Company approved successfully!');

    }
    public function show(int $id) : View
    {
        $company = $this->companyModel::find($id);
        return view('pages.admin.companies.show')->with('company', $company)->with('active', $this->currentRoute);
    }

   public function destroy($id) : RedirectResponse
    {
        $company = $this->companyModel::find($id);
        $company->cities()->detach();
        $this->companyModel::destroy($id);
        Mail::to($company->email)->send(new CompanyStatusMail('rejected',$company->name));
        return redirect()->route('admin.companies.index')->with('success', 'Company declined successfully!');
    }
}
