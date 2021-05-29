<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verifyCategoriesCount'])->only('create','store');
        $this->middleware(['auth'])->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest $request
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        //get last inserted id
        $last_id = Post::all()->count() > 0 ? Post::all()->last()->id : 0;
        $image =$request->image->store('posts');
            $post = auth()->user()->posts()->create([
            'title'         =>$request->title,
            'description'   =>$request->description,
            'contents'       =>$request->contents,
            'published_at'  =>$request->published_at,
            'image'         =>$image,
            'category_id'   =>$request->category,
            'slug' => Str::slug($request->title).'-'.$last_id+1 //random
        ]);
        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        session()->flash('success','Post Created Successfully.');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(Post $post)
    {
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title','description','contents','published_at']);
        $data['category_id'] = $request->category;
        $data['slug'] = Str::slug($request->title).'-'.$post->id;
        if($request->hasFile('image')){
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }
        $post->update($data);
        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        session()->flash('success','post updated successfully.');
        return redirect(route('posts.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        if ($post->trashed()){
            $post->forceDelete();
            $post->deleteImage();
            session()->flash('success','Trashed post has been Deleted.');
        }else{
            $post->delete();
            session()->flash('success','post has been trashed.');
        }
        return redirect(route('posts.index'));
    }

    public function trashed(){
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);
    }

    public function restore($id){
        $post = Post::withTrashed()->whereId($id)->firstOrFail();
        $post->restore();
        session()->flash('success','post has been Restored.');
        return redirect()->back();
    }

}
