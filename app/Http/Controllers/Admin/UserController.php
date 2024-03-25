<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddUserByAdminRequest;
use App\Http\Requests\UpdateUserByAdminRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\ImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class UserController extends AdminController
{
    use ImageUpload;

    public function __construct(private readonly User $userModel = new User())
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
                'title' => 'User',
                'entityName' => 'User',
                'route' => 'admin.users',
                'columns' => Schema::getColumnListing('users'),
                'values' => $this->userModel::paginate(5)
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
            'entityName' => 'User',
            'resourceName' => 'users',
            'columns' => Schema::getColumnListing('users'),
            'role' => Role::all()
        ];
        return view('pages.admin.create')->with('data', $data)->with('active', $this->currentRoute);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserByAdminRequest $request) : RedirectResponse
    {
        try{
            $array = [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password') . env('CUSTOM_STRING_FOR_HASH')),
                'role_id' => $request->input('role_id'),
                'linkedin' => $request->input('linkedin'),
                'github' => $request->input('github'),
                'is_active' => 1,
                'token' => null
            ];
            if($request->hasFile('avatar'))
            {
                $avatar = $this->resizeAndUploadImage($request->file('avatar'), 'assets/img/users/', '150', '150');
            }
            else{
                $avatar = 'user.jpg';
            }
            $array['avatar'] = $avatar;
            $this->userModel::create($array);
            return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
        }
        catch(\Exception $e)
        {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.users.index')->with('error', 'Error while adding user.');
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
    public function edit(int $id) : View|RedirectResponse
    {
        try {
            $data = [
                'entityName' => 'User',
                'resourceName' => 'users',
                'columns' => Schema::getColumnListing('users'),
                'role' => Role::all(),
                'entity' => $this->userModel::find($id)
            ];
            return view('pages.admin.edit')->with('data', $data)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.users.index')->with('error', 'An error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserByAdminRequest $request, int $id) : RedirectResponse
    {
        try{
            $user = $this->userModel::find($id);
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->role_id = $request->input('role_id');
            $user->linkedin = $request->input('linkedin');
            $user->github = $request->input('github');
            if($request->hasFile('avatar')) {
                $avatar = $this->resizeAndUploadImage($request->file('avatar'), 'assets/img/users/', '150', '150');
                if ($user->avatar != 'user.jpg')
                    unlink('assets/img/users/' . $user->avatar);
                $user->avatar = $avatar;
            }
            $user->updated_at = now();
            $user->save();
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        }
        catch(\Exception $e)
        {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.users.index')->with('error', 'Error while updating user.');
        }
    }

    public function ban(int $id) : RedirectResponse
    {
        try{
            $user = $this->userModel::find($id);
            $user->is_active = 0;
            $user->updated_at = now();
            $user->save();
            return redirect()->route('admin.users.index')->with('success', 'User banned successfully.');
        }
        catch(\Exception $e)
        {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.users.index')->with('error', 'Error while banning user.');
        }
    }

    public function unban(int $id): RedirectResponse
    {
        try{
            $user = $this->userModel::find($id);
            $user->is_active = 1;
            $user->updated_at = now();
            $user->save();
            return redirect()->route('admin.users.index')->with('success', 'User unbanned successfully.');
        }
        catch(\Exception $e)
        {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.users.index')->with('error', 'Error while unbanning user.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) : RedirectResponse
    {
        try{
            $user = $this->userModel::find($id);
            if($user->avatar != 'user.jpg')
                unlink('assets/img/users/' . $user->avatar);
            if($user->applications->count() > 0){
                return redirect()->route('admin.users.index')->with('error', 'User has applications. Cannot delete.');
            }
            if($user->saved_jobs->count() > 0){
                return redirect()->route('admin.users.index')->with('error', 'User has jobs. Cannot delete.');
            }
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        }
        catch(\Exception $e)
        {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.users.index')->with('error', 'Error while deleting user.');
        }
    }
}
