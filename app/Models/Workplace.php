<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workplace extends Model
{
    protected $table = 'workplaces';


    protected $fillable = [
        'name',
    ];

    public function jobs() : HasMany
    {
        return $this->hasMany(Job::class);
    }
}
