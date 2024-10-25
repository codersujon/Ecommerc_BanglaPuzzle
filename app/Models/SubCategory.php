<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    use HasSlug;
    protected $fillable = [
        'subcategory_name',
        'slug',
        'description',
        'is_active',
        'category_id',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('subcategory_name')
            ->saveSlugsTo('slug');
    }

    /**
     * RelationShip
     * One SubCategory belongsTo a Category
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
