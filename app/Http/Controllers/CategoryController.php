<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Categories;
use App\Models\ParentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redirect;

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


    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $request['type'] = ParentCategory::where('id', $request['parent_category_id'])->first()->name;
        $result = $request->validated();

        try {
            Categories::create($result);
            return redirect('/categories')->with('status', 'Category added Successfully');
        } catch (\Exception $e) {
            return redirect('/categories')->with('status', "Couldn't add categories");
        }
    }




    public function edit()
    {

    }


    public function destroy()
    {

    }


}
