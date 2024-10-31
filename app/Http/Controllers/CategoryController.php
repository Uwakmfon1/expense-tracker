<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $categories = Categories::where('user_id', $user)->get();
        return view('categories.index',['categories'=>$categories]);
    }

    public function create()
    {
        $user_id = Auth::id();
        $parent_category = ParentCategory::all();
        return view('categories.create',[
            'user_id'=>$user_id,
            'parent_category'=>$parent_category,
        ]);
    }


    public function store(Request $request)
    {
        $categories = Categories::all();

        $request['type'] = ParentCategory::where('id', $request['parent_category_id'])->first()->name;

        $result = $request->validate([
            'user_id'=>'required',
            'parent_category_id'=>'required',
            'name'=>'required|string|max:255',
            'type'=>'required|string|in:expense,income',
            'description'=>'required|string'
        ]);

        try {
            Categories::create($result);
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
