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
}
