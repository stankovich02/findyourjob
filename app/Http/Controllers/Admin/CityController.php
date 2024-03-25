<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CityController extends AdminController
{
    public function __construct(private readonly City $cityModel = new City())
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
                'title' => 'Cities',
                'entityName' => 'City',
                'route' => 'admin.cities',
                'columns' => Schema::getColumnListing('cities'),
                'values' => $this->cityModel->getAllAdmin()
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
            'entityName' => 'City',
            'resourceName' => 'cities',
            'columns' => Schema::getColumnListing('cities'),
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
            $this->cityModel->insert($request->input('name'));
            return redirect()->route('admin.cities.index')->with('success', 'City created successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.cities.index')->with('error', 'City not created.');
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
                'entityName' => 'City',
                'resourceName' => 'cities',
                'columns' => Schema::getColumnListing('cities'),
                'entity' => $this->cityModel::find($id)
            ];
            return view('pages.admin.edit')->with('data', $data)->with('active', $this->currentRoute);
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.cities.index')->with('error', 'An error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        try{
            $this->cityModel->updateCity($id,$request->input('name'));
            return redirect()->route('admin.cities.index')->with('success', 'City updated successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.cities.index')->with('error', 'City not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) : RedirectResponse
    {
        try{
            $city = $this->cityModel::find($id);
            if($city->companies->count() > 0){
                return redirect()->route('admin.cities.index')->with('error', 'City cannot be deleted as it is associated with companies.');
            }
            if($city->jobs->count() > 0){
                return redirect()->route('admin.cities.index')->with('error', 'City cannot be deleted as it is associated with jobs.');
            }
            $this->cityModel->deleteCity($id);
            return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.cities.index')->with('error', 'City not deleted.');
        }
    }
}
