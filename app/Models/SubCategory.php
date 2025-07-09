<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $primaryKey = 'sub_cat_id';

    protected $fillable = [
        'category_id',
        'sub_cat_name',
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'cat_id');
    }
}
