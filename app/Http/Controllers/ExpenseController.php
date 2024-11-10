<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Income;
use App\Models\ParentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Http\Requests\StoreExpenseRequest;
use Illuminate\Support\Facades\Auth;


class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expenses::all();
        return view('expenses.index',['expenses'=>$expenses]);
    }

    public function create()
    {

        $parentCategory = ParentCategory::where('id',2);
        $categories = Categories::where('parent_category_id',2)->get();
        $user_id = Auth::id();
        return view('expenses.create',[
            'categories'=>$categories,
            'user_id'=>$user_id,
        ]);
    }


    public function store(StoreExpenseRequest $request)
    {
//        dd($request);
        $validated = $request->validated();
        return $this->storeExpenses($validated);
    }


    public function edit($id)
    {
        $expenses = Expenses::where('id',$id)->get();
        return view('expenses.edit',['expenses'=>$expenses]);
    }

    public function update(Request $request)
    {

        $validated = $request->validate(['amount' => 'required|numeric|min:0']);
        return $this->updateExpenses($request->expense_id, $validated);

    }

    public function destroy(Request $request)
    {
        try{
            Expenses::where('id',$request->id)->delete();
            return redirect('/expenses')->with('status', 'Income deleted Successfully');
        }catch (\Exception $e){
            return redirect('/expenses')->with('status', "Couldn't delete income");
        }
    }




//    ======================= private functions =========
    private function storeExpenses($validated): RedirectResponse
    {
        try {
            Expenses::create($validated);
            return redirect('/expenses')->with('status','Expense Saved Successfully');
        }catch (\Exception $e){
            return redirect('/expenses')->with('status', "Couldn't save expense");
        }
    }

    private function updateExpenses($id, $validated):    RedirectResponse
    {
        try{
            Expenses::where('id',$id)->update($validated);
            return redirect()->back()->with('message', 'Expenses updated Successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('message', "Couldn't update expenses");
        }
    }
}
