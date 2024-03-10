<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BoostedJob extends Model
{
    protected $table = 'boosted_jobs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'job_id',
        'boosted_at',
        'boosted_until',
        'boosted_days',
        'total',
    ];

    public function job() : BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function insert($jobID, $boostedDays, $total) : void
    {
        $this->job_id = $jobID;
        $this->boosted_at = now();
        $this->boosted_until = now()->addDays($boostedDays);
        $this->boosted_days = $boostedDays;
        $this->total = $total;
        $this->save();
    }
}
