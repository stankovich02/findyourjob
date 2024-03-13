<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Technology extends Model
{
    protected $fillable = ['name'];

    public function jobs() : belongsToMany
    {
        return $this->belongsToMany(Job::class, 'jobs_technologies', 'technology_id', 'job_id');
    }
    public function getAll() : Collection
    {
        return self::all();
    }

    protected $table = 'technologies';
}
