<?php

namespace App\Http\Controllers\CoursesAndCategories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Traits\ApiResponseTrait;




class CategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(config('constants.PAGINATE_COUNT'));
        return $this->successResponse(
            CategoryResource::collection($categories)->response()->getData(true),
            'categories',
            'all categories  get successfully'
        );
    }

    public function categoryMainPage()
    {
        $categories = Category::paginate(config('constants.PAGINATE_COUNT'));
        return view('levels' , compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load('courses');
        return $this->successResponse(
            new CategoryResource($category),
            'Category',
            ' Category with it\'s courses get successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
