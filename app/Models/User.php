<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use App\Traits\ImageUpload;

class User extends Model
{
    use ImageUpload;
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

    public function updateSocials(int $userID, string $social, string $link) : JsonResponse
    {
        try {
            $user = User::find($userID);
            if ($social == 'github') {
                $user->github = $link;
            } else {
                $user->linkedin = $link;
            }
            $user->save();
            $socialMessage = $social == 'github' ? 'Github' : 'LinkedIn';
            return response()->json(["message" => "$socialMessage link updated."], ResponseAlias::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(["error" => "An error occurred."], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function updatePicture(int $userID, $picture) : RedirectResponse
    {
        $user = self::find($userID);
        $imageName = $this->resizeAndUploadImage($picture, 'assets/img/users/',  150, 150);
        if($user->avatar != 'user.jpg'){
            unlink(public_path('assets/img/users/' . $user->avatar));
        }
        $user->avatar = $imageName;
        session()->get('user')->avatar = $imageName;
        $user->save();
        return redirect()->route('account');
    }

    public function updateInfo(int $userID, string $firstName, string $lastName,string $email) : RedirectResponse
    {
            $user = User::find($userID);
            if ($user->email != $email) {
                $user->is_active = 0;
                $token = Str::random(20);
                $exists = User::where('token', $token)->first();
                while ($exists) {
                    $token = Str::random(20);
                    $exists = User::where('token', $token)->first();
                }
                $user->token = $token;
                Mail::to($email)->send(new \App\Mail\EmailVerification($token));
            }
            if ($user->first_name != $firstName){
                $user->first_name = $firstName;
            }
            if ($user->last_name != $lastName){
                $user->last_name = $lastName;
            }
            $user->save();
            if ($user->email != $email) {
                $user->email = $email;
                return redirect()->route('account')->with('success', 'You have successfully updated your info. Please check your email to verify your new email address.');
            }
            return redirect()->route('account')->with('success', 'You have successfully updated your info.');
    }


}
