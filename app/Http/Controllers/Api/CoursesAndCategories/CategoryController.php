<?php

namespace App\Http\Controllers\Api\CoursesAndCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCategoryRequest;
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

}
