<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'slug', 'icon', 'has_subcategory', 'show_in_home'];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
