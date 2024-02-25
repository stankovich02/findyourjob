<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
