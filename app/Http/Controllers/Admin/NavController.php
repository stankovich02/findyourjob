<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nav;
use Illuminate\Http\Request;

class NavController extends AdminController
{
    public function __construct(private readonly Nav $navModel = new Nav())
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $navs = $this->navModel->getNav();
            return view('pages.admin.navs.index')->with('navs', $navs)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.navs.create')->with('active', $this->currentRoute);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'navName' => 'required|string|max:255',
            'navRoute' => 'required|string|max:255'
        ]);
        try{
            $this->navModel->insert($request->input('navName'), $request->input('navRoute'));
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
    public function edit(string $id)
    {
        try {
            $nav = $this->navModel::find($id);
            return view('pages.admin.navs.edit')->with('nav', $nav)->with('active', $this->currentRoute);
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
            'navName' => 'required|string|max:255',
            'navRoute' => 'required|string|max:255'
        ]);
        try{
            $this->navModel->updateNav($id,$request->input('navName'), $request->input('navRoute'));
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
