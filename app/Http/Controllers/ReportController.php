<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        return view('reports.index');
    }

    public function dailyReport(){
        $incomes = Income::whereDate('created_at',Carbon::today())->get();
        $expenses = Expense::whereDate('created_at',Carbon::today())->get();
        return view('reports.dailyReport', compact('incomes', 'expenses'));
    }
}
