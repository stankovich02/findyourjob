<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workplace;
use Illuminate\Http\Request;

class WorkplaceController extends AdminController
{
    public function __construct(private readonly Workplace $workplaceModel = new Workplace())
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $workplaces = $this->workplaceModel::all();
            return view('pages.admin.workplaces.index')->with('workplaces', $workplaces)->with('active', $this->currentRoute);
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
        return view('pages.admin.workplaces.create')->with('active', $this->currentRoute);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        try {
            $this->workplaceModel::create([
                'name' => $request->name,
            ]);
            return redirect()->route('admin.workplaces.index')->with('success', 'Workplace created successfully.');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.workplaces.index')->with('error', 'An error occurred while creating workplace.');
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
            $workplace = $this->workplaceModel::find($id);
            return view('pages.admin.workplaces.edit')->with('workplace', $workplace)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            return redirect()->route('admin.workplaces.index')->with('error', 'An error occurred while editing workplace.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        try {
            $workplace = $this->workplaceModel::find($id);
            $workplace->name = $request->name;
            $workplace->updated_at = now();
            $workplace->save();
            return redirect()->route('admin.workplaces.index')->with('success', 'Workplace updated successfully.');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.workplaces.index')->with('error', 'An error occurred while updating workplace.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->workplaceModel::destroy($id);
            return redirect()->route('admin.workplaces.index')->with('success', 'Workplace deleted successfully.');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.workplaces.index')->with('error', 'An error occurred while deleting workplace.');
        }
    }
}
