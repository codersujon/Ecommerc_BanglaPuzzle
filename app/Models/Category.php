<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use HasSlug;
    protected $fillable = ['category_name', 'slug', 'description', 'is_active'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category_name')
            ->saveSlugsTo('slug');
    }

    /**
     * Relationship with SubCategory
     * One Category has Many SubCategories
<<<<<<< HEAD
    */
    public function subcategory(){
        return $this->hasMany(SubCategory::class);
    }

=======
     */
    public function subcategories(){
        return $this->hasMany(SubCategory::class);
    }
>>>>>>> add39943fc9deeb54ef449774d8c00dfad6318b8
}
