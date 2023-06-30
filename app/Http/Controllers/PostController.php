<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class PostController extends Controller
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
        //right way to write route
        $categories = Category::all();

        return Inertia::render('Post/Index', [
            'paginatePosts' => PostResource::collection(Post::paginate(10)),

        ], compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //  dd(Auth::user()->id);
        $tags = Tag::all();
        $categories = Category::all();
        if ($categories->count() == 0) {
            return redirect()->route('category.create');
        }
        if ($tags->count() == 0) {
            return redirect()->route('tag.create');
        }

        return Inertia::render('Post/Create',         [
            'categories' => Category::all()->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            }),
            'tags' => Tag::all()->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                ];
            }),
            'Auth' => Auth::user()->id,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $image = $request->file('image')->store('images', 'public');

        $post =  Post::create(
            [
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'slug' => Str::unvis($request->title),
                'image' => $image,
                'user_id' => Auth::user()->id,
            ]
        );
        $post->tags()->attach($request->tag_id);

        return Redirect::route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Inertia::render('PostPage', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return Inertia::render('Post/Edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
            'categoryName' => $post->category->name,
            'postTags' => $post->tags,
            // image preview in component
            'post_image' => asset('storage/' . $post->image),
            'Auth' => Auth::user()->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // dd($request);
        $image = $post->image;
        if ($request->hasFile('image')) {
            Storage::delete('/public' . $post->image);
            $image = $request->file('image')->store('images', 'public');
        }
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'slug' => Str::unvis($request->title),
            'image' => $image,
            'user_id' => Auth::user()->id,
        ]);
        $post->save();
        $post->tags()->sync($request->tag_id);
        return Redirect::route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        sleep(1);
        return redirect()->route('post.index')->with('message', 'Post Delete Successfully');
    }
}
