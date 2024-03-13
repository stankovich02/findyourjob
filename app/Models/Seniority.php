<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seniority extends Model
{
    protected $table = 'seniorities';


    protected $fillable = [
        'name',
    ];

    public function jobs() : HasMany
    {
        return $this->hasMany(Job::class);
    }
}
