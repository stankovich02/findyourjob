<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;

class City extends Model
{
   protected $fillable = ['name'];

   protected $table = 'cities';


   public function jobs() : HasMany
   {
      return $this->hasMany(Job::class);
   }

   public function companies() : BelongsToMany
   {
      return $this->belongsToMany(Company::class, 'companies_cities', 'city_id', 'company_id');
   }

   public function getAll() : Collection
   {
      return self::all();
   }
   public function getAllAdmin() : LengthAwarePaginator
   {
      return self::paginate(10);
   }
   public function insert(string $cityName) : void
   {
      $this->name = $cityName;
      $this->save();
   }
    public function updateCity(int $id,string $cityName) : void
    {
        $city = self::find($id);
        $city->name = $cityName;
        $city->updated_at = now();
        $city->save();
    }
    public function deleteCity(int $id) : void
    {
        $city = self::find($id);
        $city->delete();
    }
}
