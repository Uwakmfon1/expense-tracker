<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\ParentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class IncomeController extends Controller
{
    public function index()
    {
        $income = Income::all();
        return view('income.index',['income'=>$income]);
    }


    /**
     * get and display the income duration (daily, weekly, monthly, yearly)
     * get the respective id of the income type and save it to the database
     */
    public function create()
    {
        $income_type = Income::TYPES;
        $categories = Categories::where('parent_category_id',1)->get();
        $user_id = Auth::id();
        return view('income.create',[
            'user_id'=>$user_id,
            'categories'=>$categories,
            'income_type'=>$income_type
        ]);
    }


    /**
     *get form data and save to database
     */
    public function store(Request $request):RedirectResponse
    {

       $validated =  $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:one time,daily,weekly,monthly,yearly',
            'amount' => 'required|numeric|min:0',
            'received_at' => 'required|date',
            'description' => 'nullable|string|max:500',
        ]);

        try {
            Income::create($validated);
            return redirect()->back()->with('message', 'Product added Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', "Couldn't save product");
        }

    }


    public function update(Request $request)
    {

        $validated = $request->validate(['amount' => 'required|numeric|min:0']);

        try{
            Income::update($validated);
            return redirect()->back()->with('message', 'Product added Successfully');
        }catch (\Exception $e){

        }
    }

    public function edit($id)
    {
        $income = Income::where('id',$id)->get();
//        dd($income);
        return view('income.edit',['income'=>$income]);
    }


    public function destroy()
    {

    }
}
