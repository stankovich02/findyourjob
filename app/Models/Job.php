<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

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
    const STATUS_PENDING = 'pending';
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
    public function getAll(bool $latest = false,array $array = []) : Collection|LengthAwarePaginator
    {
        $query = self::with('company', 'category','city', 'seniority', 'workplace', 'technology','saved_jobs')
            ->where('status',
                self::STATUS_ACTIVE);
        if($array){
            if($array['keyword']){
                $query->where('name', 'like', '%'.$array['keyword'].'%');
            }
            if($array['category']){
                $query->where('category_id', $array['category']);
            }
            if(isset($array['cities'])){
                $query->whereIn('city_id', $array['cities']);
            }
            if($array['seniority']){
                $query->where('seniority_id', $array['seniority']);
            }
            if($array['workplace']){
                $query->where('workplace_id', $array['workplace']);
            }
            if($array['salary'] == "true")
            {
                $query->whereNotNull('salary');
            }
            if($array['workType'] !== "both")
            {
                $query->where('full_time', $array['workType'] === "1" ? 1 : 0);
            }
            if(isset($array['technologies'])){
                $technologyIds = $array['technologies'];
                $query->whereHas('technology', function($query) use ($technologyIds) {
                    $query->whereIn('technology_id', $technologyIds);
                });
            }

        }
        if($latest){
            return $query->orderByDesc('id')->paginate(5);
        }
        return $query->paginate(5);
    }
    public function getSingleJob(int $id) : Model|null
    {
        return self::with('company', 'category','city', 'seniority', 'workplace', 'saved_jobs','technology', 'applications',)
            ->find
        ($id);
    }
    public function insert($name, $category, $seniority, $workplace, $technologies, $description, $responsibilities, $requirements, $benefits, $location, $salary, $workType, $applicationDeadline, $companyId) : void
    {
        $this->name = $name;
        $this->category_id = $category;
        $this->seniority_id = $seniority;
        $this->workplace_id = $workplace;
        $this->description = $description;
        $this->responsibilities = $responsibilities;
        $this->requirements = $requirements;
        $this->benefits = $benefits;
        $this->city_id = $location;
        if($salary !== null){
            $this->salary = $salary;
        }
        $this->full_time = $workType;
        $this->application_deadline = $applicationDeadline;
        $this->company_id = $companyId;
        $this->status = self::STATUS_PENDING;
        $this->save();
        $this->technology()->attach($technologies);
    }

    public function updateRow($name, $category, $seniority, $workplace, $technologies, $description,
                              $responsibilities, $requirements, $benefits, $location, $salary, $workType,
                              $applicationDeadline, $companyId, $jobId) : void
    {
        $job = self::find($jobId);
        $job->name = $name;
        $job->category_id = $category;
        $job->seniority_id = $seniority;
        $job->workplace_id = $workplace;
        $job->description = $description;
        $job->responsibilities = $responsibilities;
        $job->requirements = $requirements;
        $job->benefits = $benefits;
        $job->city_id = $location;
        if($salary !== null){
            $job->salary = $salary;
        }
        $job->full_time = $workType;
        $job->application_deadline = $applicationDeadline;
        $job->company_id = $companyId;
        $job->save();
        $job->technology()->sync($technologies);
    }
    public function deleteRow($jobId) : void
    {
        $job = self::find($jobId);
        $job->technology()->detach();
        $job->delete();
    }

    public function saveJob($jobId, $userId) : string
    {
        try {
            $job = self::find($jobId);
            if($job->saved_jobs()->where('user_id', $userId)->exists()){
               $job->saved_jobs()->detach($userId);
                  return "Job unsaved successfully!";
            }
            $job->saved_jobs()->attach($userId, ['created_at' => now(), 'updated_at' => now()]);
            return "Job saved successfully!";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
