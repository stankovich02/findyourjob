<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{

    protected $table = "roles";

    protected $fillable = ['name'];

    public function user() : HasMany
    {
        return $this->hasMany(User::class);
    }
    public function getAll()
    {
        return self::all();
    }
    public function insert(string $name)
    {
        $this->name = $name;
        $this->save();
    }
    public function updateRole(int $id, string $name)
    {
        $role = self::find($id);
        $role->name = $name;
        $role->updated_at = now();
        $role->save();
    }
    public function deleteRole(int $id)
    {
        $role = self::find($id);
        $role->delete();
    }
}
