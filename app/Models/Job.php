<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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

    public function boosted() : HasOne
    {
        return $this->hasOne(BoostedJob::class);
    }
    public function saved_jobs() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'saved_jobs', 'job_id', 'user_id');
    }

    public function getAll(bool $latest = false,array $array = []) : Collection|LengthAwarePaginator
    {
        $queryBoosted = self::with('company', 'category', 'city', 'seniority', 'workplace', 'technology', 'saved_jobs', 'boosted')
            ->where('status', self::STATUS_ACTIVE)
            ->whereHas('boosted', function ($query) {
                $query->where('boosted_until', '>', Carbon::now());
            });

        $queryNonBoosted = self::with('company', 'category', 'city', 'seniority', 'workplace', 'technology', 'saved_jobs', 'boosted')
            ->where('status', self::STATUS_ACTIVE)
            ->whereDoesntHave('boosted', function ($query) {
                $query->where('boosted_until', '>', Carbon::now());
            });
        if($array){
            if($array['category']){
                $queryBoosted->where('category_id', $array['category']);
                $queryNonBoosted->where('category_id', $array['category']);
            }
            if($array['salary'] == "true")
            {
                $queryBoosted->whereNotNull('salary');
                $queryNonBoosted->whereNotNull('salary');
            }
            if(isset($array['cities'])){
                $queryBoosted->whereIn('city_id', $array['cities']);
                $queryNonBoosted->whereIn('city_id', $array['cities']);
            }
            if($array['seniority']){
                $queryBoosted->where('seniority_id', $array['seniority']);
                $queryNonBoosted->where('seniority_id', $array['seniority']);
            }
            if($array['workplace']){
                $queryBoosted->where('workplace_id', $array['workplace']);
                $queryNonBoosted->where('workplace_id', $array['workplace']);
            }
            if($array['workType'] !== "both")
            {
                $queryBoosted->where('full_time', $array['workType'] === "1" ? 1 : 0);
                $queryNonBoosted->where('full_time', $array['workType'] === "1" ? 1 : 0);
            }
            if(isset($array['technologies'])){
                $technologyIds = $array['technologies'];
                $queryBoosted->whereHas('technology', function($query) use ($technologyIds) {
                    $query->whereIn('technology_id', $technologyIds);
                });
                $queryNonBoosted->whereHas('technology', function($query) use ($technologyIds) {
                    $query->whereIn('technology_id', $technologyIds);
                });
            }
            if($array['keyword']){
                $keyword = $array['keyword'];
                $queryBoosted->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%')
                        ->orWhereHas('company', function ($q) use ($keyword) {
                            $q->where('name', 'like', '%' . $keyword . '%');
                        });
                });
                $queryNonBoosted->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%')
                        ->orWhereHas('company', function ($q) use ($keyword) {
                            $q->where('name', 'like', '%' . $keyword . '%');
                        });
                });
            }

        }
        $query = $queryBoosted->union($queryNonBoosted);
        if ($latest) {
            $query->orderByDesc('id');
        }

        return $query->paginate(5);

    }

    public function getAllAdmin() : Collection|LengthAwarePaginator
    {
        return self::with('company', 'category', 'city', 'seniority', 'workplace', 'technology', 'saved_jobs', 'boosted')
            ->where('status', self::STATUS_ACTIVE)
            ->paginate(5);
    }

    public function getPendingJobs() : Collection|LengthAwarePaginator
    {
        return self::with('company', 'category', 'city', 'seniority', 'workplace', 'technology', 'saved_jobs', 'boosted')
            ->where('status', self::STATUS_PENDING)
            ->paginate(5);
    }

    public function getBoosted(): Collection|LengthAwarePaginator
    {
        //get all columns from boosted relation, expired boosted also
        return self::with('company', 'boosted')
            ->whereHas('boosted', function ($query) {
                $query->where('boosted_at', 'IS NOT', null);
            })
            ->paginate(5);


    }
    public function isBoosted() : bool
    {
        return $this->boosted()->where('boosted_until', '>', Carbon::now())->exists();
    }
    public function getSingleJob(int $id) : Model|null
    {
        return self::with('company', 'category','city', 'seniority', 'workplace', 'saved_jobs','technology', 'applications',)
            ->find
        ($id);
    }
    public function insert($array) : int
    {
        $this->name = $array['name'];
        $this->category_id = $array['category'];
        $this->seniority_id = $array['seniority'];
        $this->workplace_id = $array['workplace'];
        $this->description = $array['description'];
        $this->responsibilities = $array['responsibilities'];
        $this->requirements = $array['requirements'];
        $this->benefits = $array['benefits'];
        $this->city_id = $array['location'];
        if($array['salary'] !== null){
            $this->salary = $array['salary'];
        }
        $this->full_time = $array['workType'];
        $this->application_deadline = $array['applicationDeadline'];
        $this->company_id = $array['companyId'];
        $this->status = self::STATUS_PENDING;
        $this->save();
        $this->technology()->attach($array['technologies'],['created_at' => now(), 'updated_at' => now()]);
        return $this->id;
    }

    public function updateRow($array) : int
    {
        $job = self::find($array['id']);
        if ($job == null) {
            return 0;
        }
        $job->name = $array['name'];
        $job->category_id = $array['category'];
        $job->seniority_id = $array['seniority'];
        $job->workplace_id = $array['workplace'];
        $job->description = $array['description'];
        $job->responsibilities = $array['responsibilities'];
        $job->requirements = $array['requirements'];
        $job->benefits = $array['benefits'];
        $job->city_id = $array['location'];
        if($array['salary'] !== null){
            $job->salary = $array['salary'];
        }
        $job->full_time = $array['workType'];
        $job->application_deadline = $array['applicationDeadline'];
        $job->company_id = $array['companyId'];
        $job->updated_at = now();
        $job->save();
        $job->technology()->sync($array['technologies']);
        return $job->id;
    }
    public function deleteRow($jobId) : void
    {
        $job = self::find($jobId);
        $job->technology()->detach();
        $job->applications()->delete();
        $job->saved_jobs()->detach();
        $job->boosted()->delete();
        $job->delete();
    }

    public function saveJob($jobId, $userId) : JsonResponse
    {
        $job = self::find($jobId);
        if($job == null){
            return response()->json(['error' => 'Job not found!'], ResponseAlias::HTTP_NOT_FOUND);
        }
        if($job->status == self::STATUS_EXPIRED || $job->status == self::STATUS_PENDING){
            return response()->json(['error' => 'Job is not active!'], ResponseAlias::HTTP_BAD_REQUEST);
        }
        if($job->saved_jobs()->where('user_id', $userId)->exists()){
           $job->saved_jobs()->detach($userId);
              return response()->json(['message' => 'Job unsaved successfully!'], ResponseAlias::HTTP_OK);
        }
        $job->saved_jobs()->attach($userId, ['created_at' => now(), 'updated_at' => now()]);
        return response()->json(['message' => 'Job saved successfully!'], ResponseAlias::HTTP_CREATED);
    }

    public function checkForExpiredJobs() : void
    {
        $jobs = self::where('status', self::STATUS_ACTIVE)->where('application_deadline', '<', Carbon::now())->get();
        foreach ($jobs as $job){
            $job->status = self::STATUS_EXPIRED;
            $job->save();
        }
    }
    public function approve(int $id) : array
    {
        $job = self::find($id);
        $job->status = self::STATUS_ACTIVE;
        $data= [
            'email' => $job->company->email,
            'jobName' => $job->name,
            'companyName' => $job->company->name
        ];
        $job->updated_at = now();
        $job->save();
        return $data;
    }
}
