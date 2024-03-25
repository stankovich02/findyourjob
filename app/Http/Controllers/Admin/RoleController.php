<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class RoleController extends AdminController
{
    public function __construct(private readonly Role $roleModel = new Role())
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
                'title' => 'Roles',
                'entityName' => 'Role',
                'route' => 'admin.roles',
                'columns' => Schema::getColumnListing('roles'),
                'values' => Role::all()
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
            'entityName' => 'Role',
            'resourceName' => 'roles',
            'columns' => Schema::getColumnListing('roles'),
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
            $role = $this->roleModel::find($id);
            if($role->user->count() > 0){
                return redirect()->route('admin.roles.index')->with('error', 'Role has users assigned to it.');
            }
            $this->roleModel->deleteRole($id);
            return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
        }
        catch(\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.roles.index')->with('error', 'Role not deleted.');
        }
    }
}
