<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    Protected $table = 'expense';
    protected $primaryKey = 'expense_id';

    protected $fillable = [
        'amount',
        'cat_id',
        'sub_cat_id',
        'note',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'cat_id', 'cat_id');
    }
    public function subCategory(){
        return $this->belongsTo(SubCategory::class, 'sub_cat_id', 'sub_cat_id');
    }
}
