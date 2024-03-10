<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends AdminController
{
    public function __construct(private readonly Technology $technologyModel = new Technology())
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = $this->technologyModel::paginate(10);
        return view('pages.admin.technologies.index')->with('technologies', $technologies)->with('active', $this->currentRoute);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.technologies.create')->with('active', $this->currentRoute);
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
            $this->technologyModel::create(['name' => $request->input('name')]);
            return redirect()->route('admin.technologies.index')->with('success', 'Technology created successfully.');
        }
        catch(\Exception $e){
            return redirect()->route('admin.technologies.index')->with('error', 'Technology not created.');
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
        $technology = $this->technologyModel::find($id);
        return view('pages.admin.technologies.edit')->with('technology', $technology)->with('active', $this->currentRoute);
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
            $technology = $this->technologyModel::find($id);
            $technology->name = $request->input('name');
            $technology->save();
            return redirect()->route('admin.technologies.index')->with('success', 'Technology updated successfully.');
        }
        catch(\Exception $e){
            return redirect()->route('admin.technologies.index')->with('error', 'Technology not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $this->technologyModel::destroy($id);
            return redirect()->route('admin.technologies.index')->with('success', 'Technology deleted successfully.');
        }
        catch(\Exception $e){
            return redirect()->route('admin.technologies.index')->with('error', 'Technology not deleted.');
        }
    }
}
