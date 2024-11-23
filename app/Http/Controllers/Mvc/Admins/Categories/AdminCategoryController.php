<?php

namespace App\Http\Controllers\Mvc\Admins\Categories;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Category::orderby('order', 'asc')->paginate(10);
        return view('admin.levels', ['levels' => $levels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.new_level');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLevelRequest $request)
    {
        DB::beginTransaction();

        $newOrder = $request->order;

        $this->shiftUpLevelOrder($newOrder);

        $category = Category::create([
            'name' => $request->name,
            'order' => $newOrder,
        ]);
        DB::commit();
        if ($category) {
            return redirect()->route('admin.levels')->with('success', 'level created successfully');
        }
        DB::rollBack();
        return redirect()->route('admin.levels')->with('error', 'something went wrong , try again');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $level = Category::find($id);
        return view('admin.edit_level', ['level' => $level]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLevelRequest $request, string $id)
    {
        $level = Category::find($id);
        $data = $request->validated();
        $level->update($data);
        if ($level) {
            return redirect()->route('admin.levels')->with('success', 'level updated successfully');
        }

        return redirect()->route('admin.levels')->with('error', 'something went wrong , try again');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $level = Category::find($id);
        DB::beginTransaction();
        $order = $level->order;
        $this->shiftdownLevelOrder($order);
        $success = $level->delete();
        DB::commit();
        if ($success) {
            return redirect()->route('admin.levels')->with('success', 'level deleted successfully');
        }
        DB::rollBack();
        return redirect()->route('admin.levels')->with('error', 'something went wrong , try again');
    }




    //privet function
    private function shiftUpLevelOrder($order): void
    {
        Category::where('order', '>=', $order)
            ->orderBy('order', 'asc')
            ->increment('order');
    }
    private function shiftdownLevelOrder($order): void
    {
        Category::where('order', '>=', $order)
            ->orderBy('order', 'asc')
            ->decrement('order');
    }
}
