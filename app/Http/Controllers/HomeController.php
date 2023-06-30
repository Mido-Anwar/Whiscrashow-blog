<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostResource;




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
            'getPostsOnTags',
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = DB::table('posts')->take(4)->get();

        // tap method for display post favorited function with paginate data when get POST model
        // $posts = tap(Post::paginate(12))->transform(
        //     function ($post) {
        //         return [
        //             'id' => $post->id,
        //             'title' => $post->title,
        //             'image' => $post->image,
        //             'postFavorite' => $post->favorited(),
        //             'postTags' => $post->tags->map(function ($tag) {
        //                 return [
        //                     $tag->name,
        //                 ];
        //             }),

        //         ];
        //     }
        // );

        return Inertia::render('Welcome', [
            'posts' => PostResource::collection(Post::with('category','tags',)->paginate(20)),
            'sliders' => $sliders,

        ]);
    }
    /**
     * search function
     */
    public function search(Request $request)
    {

        $posts = Post::query()
            ->when($request->input('search'),
             function ($query, $search) {
                $query->where('title', 'like', "%{$search }%");
            })->get();

            return Inertia::render('Search', [
                'posts' => $posts,
            ]);

    }
    /**
     * posts based on category
     */
    public function getCategryPosts($id)
    {
        $category = Category::find($id);

        $categoriesPosts = tap($category->posts()->paginate(10))->transform(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'image' => $post->image,
                'postFavorite' => $post->favorited(),
            ];
        });


        return Inertia::render('ShowCategories', [
            'categoriesPosts' => $categoriesPosts,
        ]);
    }
    /**
     * posts based on tags in page post links
     */
    public function getPostsOnTags($id)
    {
        $tags = Tag::find($id);

        $tagsPosts = tap($tags->posts()->paginate(10))->transform(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'image' => $post->image,
                'postFavorite' => $post->favorited(),
            ];
        });
        return Inertia::render('ShowTagsPosts', [
            'tagsPosts' => $tagsPosts,
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
    public function store(StoreHomeRequest $request)
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
        return Inertia::render('PostPage', [
            'post' => $article,
            'postTags' => $article->tags->map(function ($tag) {
                return [
                    'id' =>   $tag->id,
                    'name' =>   $tag->name,
                ];
            }),
            'author' => $article->user->name,
            'date' => $article->created_at->format('d, m, Y '),
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
