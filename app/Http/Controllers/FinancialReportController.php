<?php

namespace App\Http\Controllers;

use App\Models\FinancialReport;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FinancialReportController extends Controller
{
    public function __invoke(Request $request): View
    {
        $availableYears = FinancialReport::query()
            ->select('period_year')
            ->distinct()
            ->orderByDesc('period_year')
            ->pluck('period_year');

        $selectedYear = (int) $request->input('year', $availableYears->first() ?? now()->year);

        $reports = FinancialReport::query()
            ->where('period_year', $selectedYear)
            ->orderByDesc('period_month')
            ->get();

        $monthlySummary = $reports
            ->groupBy('period_month')
            ->map(function ($monthReports) {
                $income = $monthReports->where('type', 'income')->sum('amount');
                $expense = $monthReports->where('type', 'expense')->sum('amount');

                return [
                    'income' => $income,
                    'expense' => $expense,
                    'balance' => $income - $expense,
                    'categories' => $monthReports,
                ];
            })
            ->sortKeysDesc();

        $totalIncome = $reports->where('type', 'income')->sum('amount');
        $totalExpense = $reports->where('type', 'expense')->sum('amount');

        return view('financial-reports.index', [
            'availableYears' => $availableYears,
            'selectedYear' => $selectedYear,
            'monthlySummary' => $monthlySummary,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
        ]);
    }
}
