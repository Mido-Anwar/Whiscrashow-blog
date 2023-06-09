<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;




class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('role:Admin')->except(
            'index',
            'show',
            'getCategryPosts',
            'search',
            'favoritePost',
            'unFavoritePost',

        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $sliders = DB::table('posts')->take(4)->get();
        // tap method for display post favorited function with paginate data when get POST model
        $posts = tap(Post::paginate(12))->transform(
            function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                    'image' => $post->image,
                    'slug' => $post->slug,
                    'category_id' => $post->category_id,
                    'user_id' => $post->user_id,
                    'created_at' => $post->created_at,
                    'updated_at' => $post->updated_at,
                    'postFavorite' => $post->favorited(),
                ];
            }
        );


        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'posts' => $posts,
            'categories' => $categories,
            'sliders' => $sliders,


        ]);
    }
    /**
     * search function
     */
    public function search(Request $request)
    {
        $categories = Category::all();
        $posts = Post::query()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('title', 'like', "%" . $search . "%");
            })->get();
        return Inertia::render('Search', [
            'posts' => $posts,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'categories' => $categories,
        ]);
    }
    /**
     * posts based on category
     */
    public function getCategryPosts($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        $categoriesPosts = tap($category->posts()->paginate(10))->transform(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'image' => $post->image,
                'slug' => $post->slug,
                'category_id' => $post->category_id,
                'user_id' => $post->user_id,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'postFavorite' => $post->favorited(),
            ];
        });
        return Inertia::render('ShowCategories', [
            'categoriesPosts' => $categoriesPosts,
            'categories' => $categories,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Home/CreateSiteLogo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $image = $request->file('image')->store('logo', 'public');
        Home::create([
            "image" => $image,
        ]);
        return Redirect::route('dashboard');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Home $home, $id)
    {
        //
        $article = Post::find($id);
        //   $posts = Post::paginate(10);
        $posts = Post::all();
        //  $post = DB::table('posts')->where('id', $home)->get();
        $categories = Category::all();

        return Inertia::render('PostPage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'categories' => $categories,
            'post' => $article,
            'author' => $article->user->name,
            'created_at' => $article->created_at->format('d-m-Y'),
            'posts' => $posts,
            'favourite_list' => $article->favorited(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeRequest $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }

    // method to add  favorite posts and remove them from favorites
    /**
     * Favorite a particular post
     *
     * @param  Post $post
     * @return Response
     */
    public function favoritePost(Post $post)
    {
        Auth::user()->favorites()->attach($post->id);
        return back();
    }

    /**
     * Unfavorite a particular post
     *
     * @param  Post $post
     * @return Response
     */
    public function unFavoritePost(Post $post)
    {
        Auth::user()->favorites()->detach($post->id);
        return back();
    }
}
