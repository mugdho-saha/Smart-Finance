<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function dailyReport()
    {
        $incomes = Income::whereDate('created_at', Carbon::today())->get();
        $expenses = Expense::whereDate('created_at', Carbon::today())->get();
        $type = 'daily';
        return view('reports.report', compact('incomes', 'expenses','type'));
    }

    public function monthlyReport(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        $incomes = Income::whereBetween('created_at', [$fromDate, $toDate])->get();
        $expenses = Expense::whereBetween('created_at', [$fromDate, $toDate])->get();
        $type = 'monthly';

        return view('reports.report', compact('incomes', 'expenses','type','fromDate','toDate'));
    }
}
