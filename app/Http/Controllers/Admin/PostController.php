<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->limit(20)->get();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150|',
            'content' => 'required|string',
            'published_at' => 'nullable|date|before_or_equal:today',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $data=$request->all();
        $newPost = new Post;
        $newPost->title = $data['title'];
        $newPost->content = $data['content'];
        $newPost->category_id = $data['category_id'];
        $newPost->slug = Post::getUniqueSlug($data['title']);

        $newPost->save();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit',compact('post'),compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {   
        $request->validate([
            'title' => 'required|string|max:150|',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);
        
        $data = $request->all();

        if($post->title != $data['title']){
            $slug = Post::getUniqueSlug($data['title']);
            $data['slug'] = $slug;
        }
        
        
        $post->update($data);
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
