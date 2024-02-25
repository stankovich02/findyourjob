<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    protected $table = 'jobs';

    protected $fillable = [
        'name',
        'company_id',
        'category_id',
        'city_id',
        'seniority_id',
        'full_time',
        'workplace_id',
        'salary',
        'description',
        'responsibilities',
        'requirements',
        'benefits',
        'application_deadline',
        'status',
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_EXPIRED = 'expired';

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function seniority() : BelongsTo
    {
        return $this->belongsTo(Seniority::class);
    }
    public function workplace() : BelongsTo
    {
        return $this->belongsTo(Workplace::class);
    }
    public function applications() : HasMany
    {
        return $this->hasMany(Application::class);
    }
    public function technology() : BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'jobs_technologies', 'job_id', 'technology_id');
    }

    public function saved_jobs() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'saved_jobs', 'job_id', 'user_id');
    }
    public function getAll() : Collection
    {
       return self::with('company', 'category','city', 'seniority', 'workplace', 'technology')->get();
    }
    public function getSingleJob(int $id) : Builder|array|Collection|Model
    {
        return self::with('company', 'category','city', 'seniority', 'workplace', 'technology', 'applications')
            ->find
        ($id);
    }
}
