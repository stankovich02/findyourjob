<?php

namespace App\Http\Controllers\Admin;

use App\Mail\CompanyStatusMail;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CompanyController extends AdminController
{
    public function __construct(private readonly Company $companyModel = new Company())
    {
        parent::__construct();
    }
    public function index() : View|RedirectResponse
    {
        try {
            $data = [
                'title' => 'Companies',
                'entityName' => 'Company',
                'route' => 'admin.companies',
                'columns' => Schema::getColumnListing('companies'),
                'values' => $this->companyModel::where('status', $this->companyModel::STATUS_ACTIVE)->paginate(5)
            ];
            return view('pages.admin.index')->with('active', $this->currentRoute)
                ->with('data', $data);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred.');
        }
    }

    public function pending() : View|RedirectResponse
    {
        try {
            $data = [
                'title' => 'Pending Companies',
                'entityName' => 'Pending Company',
                'route' => 'admin.companies',
                'columns' => Schema::getColumnListing('companies'),
                'values' => $this->companyModel::where('status', $this->companyModel::STATUS_PENDING)->paginate(5)
            ];
            return view('pages.admin.index')->with('active', $this->currentRoute)
                ->with('data', $data);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred.');
        }
    }
    public function approve(int $id) : RedirectResponse
    {
        try {
            $data = $this->companyModel->approve($id);
            Mail::to($data['email'])->send(new CompanyStatusMail('approved', $data['name']));
            return redirect()->route('admin.companies.index')->with('success', 'Company approved successfully!');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.companies.index')->with('error', 'An error occurred.');
        }

    }
    public function show(int $id) : View|RedirectResponse
    {
        try{
            $company = $this->companyModel::find($id);
            return view('pages.admin.companies.show')->with('company', $company)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.companies.index')->with('error', 'An error occurred.');
        }
    }

   public function destroy($id) : RedirectResponse
    {
        try{
        $company = $this->companyModel::find($id);
        $company->cities()->detach();
        $this->companyModel::destroy($id);
        Mail::to($company->email)->send(new CompanyStatusMail('rejected',$company->name));
        return redirect()->route('admin.companies.index')->with('success', 'Company declined successfully!');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.companies.index')->with('error', 'An error occurred.');
        }
    }
}
