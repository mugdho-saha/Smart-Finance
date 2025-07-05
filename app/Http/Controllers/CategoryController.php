<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::with('user')
            ->latest()
            ->paginate(20)
            ->onEachSide(2);
        return view('category.index', compact('categories'));
    }
}
