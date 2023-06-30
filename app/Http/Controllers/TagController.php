<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class TagController extends Controller
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

        $tags = Tag::with('category:id,name')->get();
        return Inertia::render('Tag/Index', [
            'tags' =>$tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Tag/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        // dd($request);
        $tag =  Tag::create(
            [
                'name' => $request->name,
                'detailes' => $request->detailes,
                'category_id' => $request->category_id,
            ]
        );

        return Redirect::route('tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $categories = Category::all();
        return Inertia::render('Tag/Edit', [
            'tag' => $tag,
            'categories' => $categories,
            'tagCategory' => $tag->category->name,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name,
            'detailes' => $request->detailes,
            'category_id' => $request->category_id,
        ]);
        return Redirect::route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        sleep(1);
        return redirect()->route('tag.index')->with('message', 'tag Delete Successfully');
    }
}
