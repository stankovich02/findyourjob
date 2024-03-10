<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends AdminController
{
    public function __construct(private readonly City $cityModel = new City())
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = $this->cityModel->getAllAdmin();
        return view('pages.admin.cities.index')->with('cities', $cities)->with('active', $this->currentRoute);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.cities.create')->with('active', $this->currentRoute);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cityName' => 'required|string|max:255'
        ]);
        try{
            $this->cityModel->insert($request->input('cityName'));
            return redirect()->route('admin.cities.index')->with('success', 'City created successfully.');
        }
        catch(\Exception $e){
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
    public function edit(string $id)
    {
        $city = $this->cityModel::find($id);
        return view('pages.admin.cities.edit')->with('city', $city)->with('active', $this->currentRoute);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'cityName' => 'required|string|max:255'
        ]);
        try{
            $this->cityModel->updateCity($id,$request->input('cityName'));
            return redirect()->route('admin.cities.index')->with('success', 'City updated successfully.');
        }
        catch(\Exception $e){
            return redirect()->route('admin.cities.index')->with('error', 'City not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try{
            $this->cityModel->deleteCity($id);
            return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully.');
        }
        catch(\Exception $e){
            return redirect()->route('admin.cities.index')->with('error', 'City not deleted.');
        }
    }
}
