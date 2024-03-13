<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends AdminController
{
    public function __construct(private readonly Role $roleModel = new Role())
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = $this->roleModel->getAll();
            return view('pages.admin.roles.index')->with('roles', $roles)->with('active', $this->currentRoute);
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
        return view('pages.admin.roles.create')->with('active', $this->currentRoute);
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
            $this->roleModel->insert($request->input('name'));
            return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.roles.index')->with('error', 'Role not created.');
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
            $role = $this->roleModel::find($id);
            return view('pages.admin.roles.edit')->with('role', $role)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.roles.index')->with('error', 'An error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        try{
            $this->roleModel->updateRole($id,$request->input('name'));
            return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.roles.index')->with('error', 'Role not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try{
            $this->roleModel->deleteRole($id);
            return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.roles.index')->with('error', 'Role not deleted.');
        }
    }
}
