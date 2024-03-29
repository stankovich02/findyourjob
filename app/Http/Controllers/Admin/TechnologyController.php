<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use App\Models\Technology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class TechnologyController extends AdminController
{
    public function __construct(private readonly Technology $technologyModel = new Technology())
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
                'title' => 'Technologies',
                'entityName' => 'Technology',
                'route' => 'admin.technologies',
                'columns' => Schema::getColumnListing('technologies'),
                'values' => Technology::paginate(10)
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
            'entityName' => 'Technology',
            'resourceName' => 'technologies',
            'columns' => Schema::getColumnListing('technologies'),
        ];
        return view('pages.admin.create')->with('data', $data)->with('active', $this->currentRoute);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        try{
            $this->technologyModel::create(['name' => $request->input('name')]);
            return redirect()->route('admin.technologies.index')->with('success', 'Technology created successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
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
    public function edit(string $id) : View|RedirectResponse
    {
        try {
            $data = [
                'entityName' => 'Technology',
                'resourceName' => 'technologies',
                'columns' => Schema::getColumnListing('technologies'),
                'entity' => $this->technologyModel::find($id)
            ];
            return view('pages.admin.edit')->with('data', $data)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.technologies.index')->with('error', 'An error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        try{
            $technology = $this->technologyModel::find($id);
            $technology->name = $request->input('name');
            $technology->updated_at = now();
            $technology->save();
            return redirect()->route('admin.technologies.index')->with('success', 'Technology updated successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.technologies.index')->with('error', 'Technology not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $technology = $this->technologyModel::find($id);
            if($technology->jobs->count() > 0){
                return redirect()->route('admin.technologies.index')->with('error', 'Technology has jobs.');
            }
            $this->technologyModel::destroy($id);
            return redirect()->route('admin.technologies.index')->with('success', 'Technology deleted successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.technologies.index')->with('error', 'Technology not deleted.');
        }
    }
}
