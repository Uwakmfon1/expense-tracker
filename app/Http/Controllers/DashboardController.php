<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Categories;
use App\Models\Expenses;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use ConsoleTVs\Charts\Facades\Charts;

class DashboardController extends Controller
{
    /**
     * show summary of expenses
     * show summary of income
     * show summary of budget
    */
    public function show()
    {
        $expenses = Expenses::select('categories.name as category_name', DB::raw('SUM(expenses.amount) as total'))
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->groupBy('expenses.category_id', 'categories.name')
            ->get();

        $totalExpenses = Expenses::select(DB::raw('SUM(expenses.amount) as totalExpenses'))->get();
        $totalIncome = Income::select(DB::raw('SUM(incomes.amount) as totalIncome'))->get();
        $totalBudget = Budget::select(DB::raw('SUM(budgets.amount) as totalBudget'))->get();
        $category_name = $expenses->pluck('category_name');
        $totals = $expenses->pluck('total');

        foreach ($category_name as $category){
            $category1 = $category;
        }

        $totalBudget = (float) $totalBudget->first()->totalBudget;
        $totalIncome = (float) $totalIncome->first()->totalIncome;
        $totalExpenses = (float) $totalExpenses->first()->totalExpenses;

        $data = [
          'labels'=>['Budget','Income','Expenses'],
          'datasets'=>[
              [
                  'label'=>'Summary of Finances',
                  'data'=> [$totalBudget,$totalIncome,$totalExpenses],
                  'backgroundColor' => ['#ff0000', '#3cb371', '#ffa500'],
                'borderColor' => ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'],
              ],
          ],
        ];


        return view('dashboard',[
            'data'=> $data,
            'category_name'=>$category_name,
            'totals'=>$totals,
            'expenses'=>$expenses,
            'totalExpenses'=>$totalExpenses,
            'totalIncome'=>$totalIncome,
            'totalBudget'=>$totalBudget,
            'category1'=> $category1,

        ]);
    }
}
