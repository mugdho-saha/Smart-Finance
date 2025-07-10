<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index(){
        $subcategories = SubCategory::with('category')
        ->latest()->paginate(20)->onEachSide(2);
        $categories = Category::all();
        return view('subCategory.index', compact('categories','subcategories'));
    }

    public function store(Request $request){
        $request->validate([
            'category_id' => 'required|exists:categories,cat_id',
            'sub_cat_name' => 'required|unique:sub_categories,sub_cat_name',
        ]);
        SubCategory::create([
            'category_id' => $request->category_id,
            'sub_cat_name' => $request->sub_cat_name,
            'slug' => Str::slug($request->sub_cat_name),
        ]);
        return redirect()->route('subcategory.index')->with('success', 'Sub-Category created successfully.');
    }

    public function destroy($sub_cat_id)
    {
        $sub_category = SubCategory::findOrFail($sub_cat_id);
        $sub_category->delete();

        return redirect()->route('subcategory.index')->with('success', 'Sub-Category deleted successfully.');
    }

    public function edit($slug)
    {
        $subcategory = SubCategory::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return view('subCategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $sub_cat_id)
    {
        $request->validate([
            'sub_cat_name' => 'required|unique:sub_categories,sub_cat_name,' . $sub_cat_id . ',sub_cat_id',
            'cat_id' => 'required|exists:categories,cat_id',
        ]);

        $subcategory = SubCategory::findOrFail($sub_cat_id);
        $subcategory->sub_cat_name = $request->sub_cat_name;
        $subcategory->slug = \Illuminate\Support\Str::slug($request->sub_cat_name);
        $subcategory->category_id = $request->cat_id;
        $subcategory->save();

        return redirect()->route('subcategory.index')->with('success', 'Sub-Category updated successfully.');
    }
}
