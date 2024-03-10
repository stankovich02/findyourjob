<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Nav extends Model
{
    protected $table = "nav";

    protected $fillable = ['name', 'route'];

    public function getNav() : Collection
    {
        return self::all();
    }
    public function insert(string $navName, string $navRoute) : void
    {
        $this->name = $navName;
        $this->route = $navRoute;
        $this->save();
    }
    public function updateNav(int $id, string $navName, string $navRoute) : void
    {
        $nav = self::find($id);
        $nav->name = $navName;
        $nav->route = $navRoute;
        $nav->save();
    }
    public function deleteNav(int $id) : void
    {
        $nav = self::find($id);
        $nav->delete();
    }
}
