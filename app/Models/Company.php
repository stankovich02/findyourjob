<?php

namespace App\Models;

use App\Traits\ImageUpload;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

/**
 * Company
 *
 * @mixin Eloquent
 */
class Company extends Model
{
    use ImageUpload;
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

    public function getCompany(int $id) : Collection|Model
    {
        return self::with('jobs','cities')->find($id);
    }
    public function getAll() : Collection|Model
    {
        return self::where('status', self::STATUS_ACTIVE)->get();
    }

    public function insert(array $array) : int
    {
            $array['password'] = Hash::make($array['password'] . env('CUSTOM_STRING_FOR_HASH'));
            $this->name = $array['name'];
            $this->email = $array['email'];
            $this->password = $array['password'];
            $this->logo = 'user.jpg';
            if (isset($array['website']))
            {
                $this->website = $array['website'];
            }
            $this->phone = $array['phone'];
            $this->description = $array['description'];
            $this->save();
            $this->cities()->attach($array['cities'], ['created_at' => now(), 'updated_at' => now()]);
            return $this->id;
    }

    public function getCompanyLocations(int $id) : Builder|array|Collection|Model
    {
        return self::with('cities')->find($id);
    }

    public function updateCompany($id,$name,$description,$email,$website,$phone) : RedirectResponse|Response
    {
        $company = self::find($id);
        if ($company == null) {
            return redirect()->route('account.index')->with('error', 'Company not found.');
        }
        $company->name = $name;
        $company->description = $description;
        $company->email = $email;
        $company->website = $website;
        $company->phone = $phone;
        $company->updated_at = now();
        session()->get('user')->name = $name;
        $company->save();
        return redirect()->route('account.index')->with('success', 'You have successfully updated company info.');
    }
    public function updateLogo($companyID, $logo) : void
    {
        $company = self::find($companyID);
        $imageName = $this->resizeAndUploadImage($logo, 'assets/img/companies/', 150, 150);
        if($company->logo != 'user.jpg'){
            unlink(public_path('assets/img/companies/' . $company->logo));
        }
        $company->logo = $imageName;
        session()->get('user')->logo = $imageName;
        $company->updated_at = now();
        $company->save();
    }
    public function updatePassword(int $userID, string $oldPassword, string $newPassword) : bool
    {
        $company = self::find($userID);
        if (!Hash::check($oldPassword . env('CUSTOM_STRING_FOR_HASH'), $company->password)) {
            return false;
        }
        $company->password = Hash::make($newPassword . env('CUSTOM_STRING_FOR_HASH'));
        $company->updated_at = now();
        $company->save();
        return true;
    }
    public function approve(int $id) : array
    {
        $company = self::find($id);
        $company->status = self::STATUS_ACTIVE;
        $company->updated_at = now();
        $company->save();
        return ['email' => $company->email, 'name' => $company->name];
    }
}
