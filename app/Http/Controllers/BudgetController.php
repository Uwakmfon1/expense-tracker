<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBudgetRequest;
use App\Models\Budget;
use App\Models\Categories;
use App\Models\Income;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budget = Budget::all();
//        $formatted_start_date = Carbon::parse()
        return view('budget.index',[
            'budget'=>$budget,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::where('parent_category_id',2)->get();
        return view('budget.create',[
            'categories'=>$categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBudgetRequest $request)
    {
        $validated = $request->validated();
//    dd($validated);

        $validated['user_id'] = Auth::id();
        return $this->saveBudget($validated);
    }



    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $budget = Budget::where('id',$id)->get();
        return view('budget.edit',['budget'=>$budget]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate(['amount' => 'required|numeric|min:0']);
        return $this->updateRecord($request->budget_id, $validated);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            Budget::where('id',$request->id)->delete();
            return redirect('/budget')->with('status', 'Budget deleted Successfully');
        }catch (\Exception $e){
            return redirect('/budget')->with('status', "Couldn't delete Budget");
        }
    }





    private function saveBudget($validatedRequest):RedirectResponse
    {
        try {
            Budget::create($validatedRequest);
            return redirect('/budget')->with('status', 'Budget added Successfully');
        } catch (\Exception $e) {
            return redirect('/budget')->with('status', "Couldn't save Budget");
        }
    }

    private function updateRecord($id, $validated):RedirectResponse
    {
        try{
            Budget::where('id',$id)->update($validated);
            return redirect('/budget')->with('status', 'Budget updated Successfully');
        }catch (\Exception $e){
            return redirect('/budget')->with('status', "Couldn't update Budget");
        }
    }







}
