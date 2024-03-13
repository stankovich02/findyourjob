<?php

namespace App\Models;

use App\Traits\ImageUpload;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use ImageUpload;
    protected $fillable = ['name'];

    protected $table = 'categories';

    public function jobs() : HasMany
    {
        return $this->hasMany(Job::class);
    }
    public function getAll() : Collection
    {
        return self::all();
    }
    public function insert(string $name, $icon) : void
    {
        $newIcon = $this->resizeAndUploadImage($icon,'assets/img/', 64, 64);
        $this->name = $name;
        $this->icon = $newIcon;
        $this->save();
    }
    public function updateCategory(string $name, $icon , string $id) : void
    {
        $category = self::find($id);
        $category->name = $name;
        if($icon){
            $newIcon = $this->resizeAndUploadImage($icon,'assets/img/', 64, 64);
            unlink(public_path('assets/img/'.$category->icon));
            $category->icon = $newIcon;
        }
        $category->updated_at = now();
        $category->save();
    }
    public function deleteCategory(string $id) : void
    {
        $category = self::find($id);
        unlink(public_path('assets/img/'.$category->icon));
        $category->delete();
    }
}
