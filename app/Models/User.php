<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'linkedin',
        'github',
        'avatar',
        'role_id',
        'is_active',
        'token',
    ];

    protected $hidden = [
        'password',
    ];

    public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function saved_jobs() : BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'saved_jobs', 'user_id', 'job_id');
    }

    public function applications() : BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'applications', 'user_id', 'job_id');
    }
    public function insert(array $array) : string
    {
      try {
          $this->first_name = $array['first_name'];
          $this->last_name = $array['last_name'];
          $this->email = $array['email'];
          $this->password = Hash::make($array['password'] . env('CUSTOM_STRING_FOR_HASH'));
          $this->role_id = 1;
          $this->is_active = 0;
          $this->avatar = 'user.jpg';
          $token = Str::random(20);
          $exists = User::where('token', $token)->first();
          while ($exists) {
              $token = Str::random(20);
              $exists = User::where('token', $token)->first();
          }
          $this->token = $token;
          $this->save();
          return $token;
      } catch (\Exception $e) {
          return $e->getMessage();
      }
    }
    public function verify($token) : bool|string
    {
        try {
            $user = User::where('token', $token)->first();
            if ($user) {
                $user->is_active = 1;
                $user->token = null;
                $user->save();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}
