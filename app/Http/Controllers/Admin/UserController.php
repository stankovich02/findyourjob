<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddUserByAdminRequest;
use App\Http\Requests\UpdateUserByAdminRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

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
    public function index()
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
    public function create()
    {
        return view('pages.admin.users.create')->with('roles', Role::all())->with('active', $this->currentRoute);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserByAdminRequest $request)
    {
        try{
            $array = [
                'first_name' => $request->input('firstName'),
                'last_name' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password') . env('CUSTOM_STRING_FOR_HASH')),
                'role_id' => $request->input('role'),
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
    public function edit(int $id)
    {
        try {
            $user = $this->userModel::find($id);
            return view('pages.admin.users.edit')->with('user', $user)->with('roles', Role::all())->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.users.index')->with('error', 'An error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserByAdminRequest $request, int $id)
    {
        try{
            $user = $this->userModel::find($id);
            $user->first_name = $request->input('firstName');
            $user->last_name = $request->input('lastName');
            $user->email = $request->input('email');
            $user->role_id = $request->input('role');
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

    public function ban(int $id)
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

    public function unban(int $id)
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
    public function destroy(int $id)
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
