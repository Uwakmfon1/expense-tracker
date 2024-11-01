<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncomeRequest;
use App\Models\Categories;
use Illuminate\Http\RedirectResponse;
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
    public function store(StoreIncomeRequest $request)
    {
        $validatedRequest = $request->validated();
        return $this->storeIncome($validatedRequest);
    }


    public function edit($id)
    {
        $income = Income::where('id',$id)->get();
        return view('income.edit',['income'=>$income]);
    }


    public function update(Request $request)
    {
        $validated = $request->validate(['amount' => 'required|numeric|min:0']);
        return $this->updateRecord($request->income_id, $validated);

    }


    public function destroy()
    {

    }



    private function storeIncome($validatedRequest):RedirectResponse
    {
        try {
            Income::create($validatedRequest);
            return redirect()->back()->with('message', 'Income added Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', "Couldn't save income");
        }
    }

    private function updateRecord($id, $validated):RedirectResponse
    {
        try{
            //Find the record by ID and update with validated data
            Income::where('id',$id)->update($validated);
            return redirect()->back()->with('message', 'Income updated Successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('message', "Couldn't update income");
        }
    }

}
