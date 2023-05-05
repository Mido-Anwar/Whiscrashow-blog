<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Category/Index', [
            'categories' => Category::all()->map(function ($category) {
                return [
                    'id' =>      $category->id,
                    'name' =>    $category->name,
                    'detailes' => $category->detailes,
                ];
            }),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category =  Category::create(
            [
                'name' => $request->name,
                'detailes' => $request->detailes,

            ]
        );

        return Redirect::route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('Category/Edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'detailes'=>$request->detailes,
        ]);
        return Redirect::route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        sleep(1);
        return redirect()->route('category.index')->with('message', 'category Delete Successfully');
    }
}
