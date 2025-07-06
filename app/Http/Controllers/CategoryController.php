<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Dotenv\Util\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::with('user')
            ->latest()
            ->paginate(20)
            ->onEachSide(2);
        $users = User::all();
        return view('category.index', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|unique:categories,cat_name',
            'user_id' => 'required|exists:users,id',
        ]);

        Category::create([
            'cat_name' => $request->cat_name,
            'slug' => \Illuminate\Support\Str::slug($request->cat_name),
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function destroy($cat_id)
    {
        $category = Category::findOrFail($cat_id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }


    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $users = User::all(); // if you need users to populate a dropdown
        return view('category.edit', compact('category', 'users'));
    }


    public function update(Request $request, $cat_id)
    {
        $request->validate([
            'cat_name' => 'required|unique:categories,cat_name,' . $cat_id . ',cat_id',
            'user_id' => 'required|exists:users,id',
        ]);

        $category = Category::findOrFail($cat_id);
        $category->cat_name = $request->cat_name;
        $category->slug = \Illuminate\Support\Str::slug($request->cat_name);
        $category->user_id = $request->user_id;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

}
