<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

/**
 * Company
 *
 * @mixin Eloquent
 */
class Company extends Model
{
    const STATUS_ACTIVE = 'active';
    const STATUS_PENDING = 'pending';

    protected $fillable = [
        'name',
        'email',
        'password',
        'logo',
        'website',
        'phone',
        'description'
    ];

    protected $table = 'companies';


    protected $hidden = [
        'password'
    ];

    public function jobs() : HasMany
    {
        return $this->hasMany(Job::class);
    }
    public function cities() : BelongsToMany
    {
        return $this->belongsToMany(City::class, 'companies_cities', 'company_id', 'city_id');
    }

    public function getCompany(int $id) : Builder|array|Collection|Model
    {
        return self::with('jobs','cities')->find($id);
    }

    public function insert(array $array) : string
    {
        try {
            $array['password'] = Hash::make($array['password'] . env('CUSTOM_STRING_FOR_HASH'));
            $this->name = $array['name'];
            $this->email = $array['email'];
            $this->password = $array['password'];
            $this->logo = null;
            $this->website = $array['website'];
            $this->phone = $array['phone'];
            $this->description = null;
            $this->save();
            $this->cities()->attach($array['cities'], ['created_at' => now(), 'updated_at' => now()]);

            return 'You have successfully registered company! Please wait for the admin to verify your account. You will receive an email once your account is verified.';
        } catch (\Exception $e) {
            /*if(File::exists(public_path('/assets/img/products/' . $imageName))){
                File::delete(public_path('/assets/img/products/' . $imageName));
            }*/
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
    public function resizeAndUploadImage($imageFromArray, int $width, int $height, string $name) : string
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
            $resizeImagePath = public_path("assets/img/companies/") . $name . '.' . $extension;

            $resizedImage = imagecreatetruecolor($width, $height);
            imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $width, $height, $imgWidth, $imgHeight);
            move_uploaded_file($tmpPath, $resizeImagePath);
            if($type=='image/jpeg') imagejpeg($resizedImage,  $resizeImagePath );
            if($type=='image/png') imagepng($resizedImage,  $resizeImagePath);


        return $name . '.' . $extension;
    }
    public function getCompanyLocations(int $id) : Builder|array|Collection|Model
    {
        return self::with('cities')->find($id);
    }

    public function updateCompany($id,$name,$description,$email,$website,$phone) : RedirectResponse
    {
        try {
            $company = self::find($id);
            if ($company == null) {
                return redirect()->route('home');
            }
            if ($company->name != $name) {
                $company->name = $name;
            }
            if ($company->description != $description) {
                $company->description = $description;
            }
            if ($company->email != $email) {
                $company->email = $email;
            }
            if ($company->website != $website) {
                $company->website = $website;
            }
            if ($company->phone != $phone) {
                $company->phone = $phone;
            }
            $company->save();
            return redirect()->route('account')->with('success', 'You have successfully updated company info.');
        } catch (\Exception $e) {
            return redirect()->route('account')->with('error', 'An error occurred.');
        }
    }
}
