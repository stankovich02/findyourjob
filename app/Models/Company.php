<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

/**
 * Company
 *
 * @mixin Eloquent
 */
class Company extends Model
{
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
            if (isset($array['logo'])) {

                $imageName = $this->resizeAndUploadImage($array['logo'], 150, 150, $array['name']);
                $array['logo'] = $imageName;
            }
            $array['password'] = Hash::make($array['password'] . env('CUSTOM_STRING_FOR_HASH'));
            $this->fill($array);
            $this->save();
            return true;
        } catch (\Exception $e) {
            if(File::exists(public_path('/assets/img/products/' . $imageName))){
                File::delete(public_path('/assets/img/products/' . $imageName));
            }
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
}
