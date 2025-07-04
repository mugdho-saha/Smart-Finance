<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'cat_id';

    protected $fillable = [
        'cat_name',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
