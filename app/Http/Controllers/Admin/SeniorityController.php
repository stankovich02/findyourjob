<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seniority;
use Illuminate\Http\Request;

class SeniorityController extends AdminController
{
    public function __construct(private readonly Seniority $seniorityModel = new Seniority())
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $seniorities = $this->seniorityModel::all();
            return view('pages.admin.seniorities.index')->with('seniorities', $seniorities)->with('active', $this->currentRoute);
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
        return view('pages.admin.seniorities.create')->with('active', $this->currentRoute);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        try{
            $this->seniorityModel::create(['name' => $request->input('name')]);
            return redirect()->route('admin.seniorities.index')->with('success', 'Seniority created successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.seniorities.index')->with('error', 'Seniority not created.');
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
            $seniority = $this->seniorityModel::find($id);
            return view('pages.admin.seniorities.edit')->with('seniority', $seniority)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.seniorities.index')->with('error', 'An error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        try{
            $seniority = $this->seniorityModel::find($id);
            $seniority->name = $request->input('name');
            $seniority->updated_at = now();
            $seniority->save();
            return redirect()->route('admin.seniorities.index')->with('success', 'Seniority updated successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.seniorities.index')->with('error', 'Seniority not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $seniority = $this->seniorityModel::find($id);
            if($seniority->jobs->count() > 0)
                return redirect()->route('admin.seniorities.index')->with('error', 'Seniority not deleted. It is being used by a job.');
            $seniority->delete();
            return redirect()->route('admin.seniorities.index')->with('success', 'Seniority deleted successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.seniorities.index')->with('error', 'Seniority not deleted.');
        }
    }
}
