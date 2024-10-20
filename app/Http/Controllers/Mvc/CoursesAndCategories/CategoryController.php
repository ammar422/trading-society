<?php

namespace App\Http\Controllers\Mvc\CoursesAndCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;




class CategoryController extends Controller
{
   
    

    public function categoryMainPage()
    {
        $categories = Category::paginate(config('constants.PAGINATE_COUNT'));
        return view('levels', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

   


    public function edit()
    {
        return view('edit_category');
    }


    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
