<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $today_expense = Expense::whereDate('created_at', Carbon::today())->sum('amount');
        $today_income = Income::whereDate('created_at', Carbon::today())->sum('amount');
        $monthly_expense = Expense::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('amount');
        $monthly_income = Income::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('amount');
        $total_expense = Expense::all()->sum('amount');
        $total_income = Income::all()->sum('amount');
        $total_category = Category::all()->count();
        $total_sub_category = SubCategory::all()->count();
        // Get current year
        $year = Carbon::now()->year;

        // Fetch monthly income
        $incomes = Income::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total')
        )
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month')
            ->toArray();

        // Fetch monthly expense
        $expenses = Expense::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total')
        )
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month')
            ->toArray();

        // Prepare data for chart (Jan–Dec)
        $months = [];
        $incomeData = [];
        $expenseData = [];

        for ($m = 1; $m <= 12; $m++) {
            $months[] = Carbon::create()->month($m)->format('M'); // Jan, Feb, ...
            $incomeData[] = $incomes[$m] ?? 0;
            $expenseData[] = $expenses[$m] ?? 0;
        }
        return view('dashboard',compact('today_expense','today_income','monthly_expense','monthly_income','total_expense','total_income','total_category','total_sub_category','months','incomeData','expenseData'));
    }
}
