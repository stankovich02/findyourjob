<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class NavController extends AdminController
{
    public function __construct(private readonly Nav $navModel = new Nav())
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View|RedirectResponse
    {
        try {
            $data = [
                'title' => 'Navigations',
                'entityName' => 'Nav',
                'route' => 'admin.navs',
                'columns' => Schema::getColumnListing('nav'),
                'values' => Nav::all()
            ];
            return view('pages.admin.index')->with('active', $this->currentRoute)
                ->with('data', $data);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $data = [
            'entityName' => 'Navigation',
            'resourceName' => 'navs',
            'columns' => Schema::getColumnListing('nav'),
        ];
        return view('pages.admin.create')->with('data', $data)->with('active', $this->currentRoute);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'required|string|max:255'
        ]);
        try{
            $this->navModel->insert($request->input('name'), $request->input('route'));
            return redirect()->route('admin.navs.index')->with('success', 'Navigation created successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.navs.index')->with('error', 'Navigation not created.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View|RedirectResponse
    {
        try {
            $data = [
                'entityName' => 'Navigation',
                'resourceName' => 'navs',
                'columns' => Schema::getColumnListing('nav'),
                'entity' => $this->navModel::find($id)
            ];
            return view('pages.admin.edit')->with('data', $data)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.navs.index')->with('error', 'An error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'required|string|max:255'
        ]);
        try{
            $this->navModel->updateNav($id,$request->input('name'), $request->input('route'));
            return redirect()->route('admin.navs.index')->with('success', 'Navigation updated successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.navs.index')->with('error', 'Navigation not created.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $this->navModel->deleteNav($id);
            return redirect()->route('admin.navs.index')->with('success', 'Navigation deleted successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.navs.index')->with('error', 'Navigation not deleted.');
        }
    }
}
