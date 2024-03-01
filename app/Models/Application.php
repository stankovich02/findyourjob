<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
   protected $table = 'applications';

    protected $fillable = [
        'job_id',
        'user_id',
        'uploaded_file',
    ];

    public function job() : BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function store($file, string $coverLetter, $jobID, $userID) : void
    {
        $this->job_id = $jobID;
        $this->user_id = $userID;
        $this->cover_letter = $coverLetter;
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->getPathname();
        move_uploaded_file($filePath, public_path("assets/applications/" . $fileName));
        $this->uploaded_file = $fileName;
        $this->save();
    }
    public function getApplication($id) : Application|Collection
    {
        return self::with('user')->find($id);
    }
}
