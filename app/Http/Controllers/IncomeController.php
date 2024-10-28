<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function index()
    {
        $income = Income::all();
        return view('income.index',['income'=>$income]);
    }

    //displays form to create an income
    /**
     * get and display the income duration (daily, weekly, monthly, yearly)
     * get the respective id of the income type and save it to the database
     */
    public function create()
    {
        $income_type = Income::TYPES;
        $categories = Categories::where('parent_category_id',2)->get();
        $user_id = Auth::id();
        return view('income.create',[
            'user_id'=>$user_id,
            'categories'=>$categories,
            'income_type'=>$income_type
        ]);
    }

    //function to save the income to the database
    /**
     *get form data
     */
    public function store(Request $request)
    {
//        dd($request);

        $result = $request->validate([
            'category_id'=>'required',
            'name'=>'required|string|max:255',
            'type'=>'required|string|in:expense,income',
            'amount'=>'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'received_at'=>'required|date',
            'description'=>'nullable|string',
        ]);

//        dd($result);

        try {
            Income::create($request);
            return redirect()->back()->with('message', 'Product added Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', "Couldn't save product");
        }

    }


    public function edit()
    {

    }


    public function destroy()
    {

    }
}
