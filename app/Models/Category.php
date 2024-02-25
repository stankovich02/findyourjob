<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name'];

    public function jobs() : HasMany
    {
        return $this->hasMany(Job::class);
    }
    public function getAll() : Collection
    {
        return self::all();
    }
}
