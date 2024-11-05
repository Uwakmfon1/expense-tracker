<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use ConsoleTVs\Charts\Facades\Charts;

class DashboardController extends Controller
{
    public function show()
    {

//        $chart = Charts::create('pie', 'chartjs')
//            ->title('Spending by Category')
//            ->labels(['Food', 'Transport', 'Entertainment'])
//            ->values([500, 300, 200])
//            ->dimensions(1000, 500)
//            ->responsive(true);


        $expenses = Expenses::select('categories.name as category_name', DB::raw('SUM(expenses.amount) as total'))
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->groupBy('expenses.category_id', 'categories.name')
            ->get();

        $category_name = $expenses->pluck('category_name');
        $totals = $expenses->pluck('total');
        foreach ($category_name as $category){
            $category1 = $category;
        }
        return view('dashboard',[
            'category_name'=>$category_name,
            'totals'=>$totals,
            'expenses'=>$expenses,
            'category1'=> $category1
        ]);
    }
}
