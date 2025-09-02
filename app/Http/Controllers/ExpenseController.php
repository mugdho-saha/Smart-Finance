<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(){
        $categories = Category::all();
        $expenses = Expense::with('category','subCategory')->latest()->paginate(20)->onEachSide(2);
        return view('expense.index', compact('categories', 'expenses'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'amount' => 'required',
            'cat_id' => 'required',
            'sub_cat_id' => 'required',
            'note' => 'nullable',
        ]);
        Expense::create($validated);
        return redirect()->route('expense.index')->with('success', 'Expense added successfully');
    }

    public function destroy($expense_id){
        $expense = Expense::findOrFail($expense_id);
        $expense->delete();
        return redirect()->route('expense.index')->with('success', 'Expense deleted successfully');
    }

    public function edit($expense_id){
        $categories = Category::all();
        $expense = Expense::where('expense_id', $expense_id)->with('category','subCategory')->first();
        return view('expense.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, $expense_id){
        $validated = $request->validate([
            'amount' => 'required',
            'cat_id' => 'required',
            'sub_cat_id' => 'required',
            'note' => 'nullable',
        ]);
        $expense = Expense::findOrFail($expense_id);
        $expense->update($request->all());
        return redirect()->route('expense.index')->with('success', 'Expense updated successfully');
    }
}
