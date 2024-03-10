<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserByAdminRequest;
use App\Http\Requests\UpdateUserByAdminRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageUpload;

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
        $users = $this->userModel::paginate(5);
        return view('pages.admin.users.index')->with('users', $users)->with('active', $this->currentRoute);
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
        $user = $this->userModel::find($id);
        return view('pages.admin.users.edit')->with('user', $user)->with('roles', Role::all())->with('active', $this->currentRoute);
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
            $user->save();
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        }
        catch(\Exception $e)
        {
            return redirect()->route('admin.users.index')->with('error', 'Error while updating user.');
        }
    }

    public function ban(int $id)
    {
        try{
            $user = $this->userModel::find($id);
            $user->is_active = 0;
            $user->save();
            return redirect()->route('admin.users.index')->with('success', 'User banned successfully.');
        }
        catch(\Exception $e)
        {
            return redirect()->route('admin.users.index')->with('error', 'Error while banning user.');
        }
    }

    public function unban(int $id)
    {
        try{
            $user = $this->userModel::find($id);
            $user->is_active = 1;
            $user->save();
            return redirect()->route('admin.users.index')->with('success', 'User unbanned successfully.');
        }
        catch(\Exception $e)
        {
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
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        }
        catch(\Exception $e)
        {
            return redirect()->route('admin.users.index')->with('error', 'Error while deleting user.');
        }
    }
}