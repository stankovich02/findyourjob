<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
            return response()->json(["message" => "$socialMessage link updated."], 204);
        } catch (\Exception $e) {
            return response()->json(["message" => "An error occurred."], 500);
        }
    }
    public function updatePicture(int $userID, $picture,$accType) : RedirectResponse
    {
        try {
            if ($accType == 'company') {
                $company = Company::find($userID);
                $company->logo = $picture->store('logos', 'public');
                $company->save();
                return redirect()->route('account');
            }
            $user = User::find($userID);
            $imageName = $this->resizeAndUploadImage($picture, 150, 150);
            if($user->avatar != 'user.jpg'){
                unlink(public_path('assets/img/users/' . $user->avatar));
            }
            $user->avatar = $imageName;
            session()->get('user')->avatar = $imageName;
            $user->save();
            return redirect()->route('account');
        } catch (\Exception $e) {
            return redirect()->route('account')->with('error', 'An error occurred.');
        }
    }
    public function resizeAndUploadImage($imageFromArray, int $width, int $height) : string
    {
        $tmpPath = $imageFromArray->getPathname();
        $type = $imageFromArray->getMimeType();
        $extension = $imageFromArray->getClientOriginalExtension();
        list($imgWidth, $imgHeight) = getimagesize($tmpPath);
        if ($type == "image/jpeg") {
            $originalImage = imagecreatefromjpeg($tmpPath);
        } elseif ($type == "image/png") {
            $originalImage = imagecreatefrompng($tmpPath);
        }
        $imageName = time() . '.' . $extension;
        $resizeImagePath = public_path("assets/img/users/") . $imageName;

        $resizedImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $width, $height, $imgWidth, $imgHeight);
        move_uploaded_file($tmpPath, $resizeImagePath);
        if($type=='image/jpeg') imagejpeg($resizedImage,  $resizeImagePath );
        if($type=='image/png') imagepng($resizedImage,  $resizeImagePath);


        return $imageName;
    }


}
