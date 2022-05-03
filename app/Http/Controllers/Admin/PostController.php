<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Post;
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
        return view('admin.posts.create');
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
            'published_at' => 'nullable|date|before_or_equal:today'
        ]);

        $data=$request->all();
        $newPost = new Post;
        $newPost->title = $data['title'];
        $newPost->content = $data['content'];

        $slug = Str::slug($newPost->title);
        $slugTmp = $slug; //variabile temporanea 
        $counter = 1; //contatore
        $dbSlug = Post::where('slug',$slug)->first();//cerco se presente slug creato
        
        while( $dbSlug ){ //cicla se trovi slug nel db
            $slug = $slugTmp .'-' .$counter;
            $counter++;    
            $dbSlug = Post::where('slug',$slug)->first();
        }

        $newPost->slug = $slug;

        
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
        return view('admin.posts.edit',compact('post'));
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
            'published_at' => 'nullable|date'
        ]);
        
        $data = $request->all();
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
