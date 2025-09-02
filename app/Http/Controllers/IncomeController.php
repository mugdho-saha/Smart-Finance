<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Income;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(){
        $categories = Category::all();
        $incomes = Income::with('category','subCategory')->latest()->paginate(20)->onEachSide(2);
        return view('income.index', compact('categories', 'incomes'));
    }

    public function getSubCategories(Request $request)
    {
        $categoryId = $request->category_id;

        $subCategories = SubCategory::where('category_id', $categoryId)->get(['sub_cat_id', 'sub_cat_name']);

        return response()->json($subCategories);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'amount' => 'required',
            'cat_id' => 'required',
            'sub_cat_id' => 'required',
            'note' => 'nullable',
        ]);
        Income::create($validated);
        return redirect()->back()->with('success', 'Income added successfully');
    }

    public function destroy($income_id){
        $income = Income::findOrFail($income_id);
        $income->delete();
        return redirect()->route('income.index')->with('success', 'Income deleted successfully');
    }

    public function edit($income_id){
        $categories = Category::all();
        $income = Income::where('income_id', $income_id)->with('category','subCategory')->firstOrFail();
        return view('income.edit', compact('categories', 'income'));
    }

    public function update(Request $request, $income_id){
        $request->validate([
            'amount' => 'required',
            'cat_id' => 'required',
            'sub_cat_id' => 'required',
            'note' => 'nullable',
        ]);

        $income = Income::findOrFail($income_id);
        $income->update($request->all());
        return redirect()->route('income.index')->with('success', 'Income updated successfully');
    }
}
