<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $posts = $this->getPosts();
        $categories = Category::all();
        $tags = Tag::all();
        return view('home',[
            'posts'=>$posts,
            'categories'=>$categories,
            'tags'=>$tags
        ]);
    }

    public function getPosts(){
        //paginate count
        $paginator =6;
        $tagQuery = request()->query('tag');
        $categoryQuery = request()->query('category');
        $searchQuery = request()->query('search');

        if ($tagQuery){
            $tag = Tag::where('slug',$tagQuery)->firstOrFail();
            if ($categoryQuery){
                $category = Category::where('slug',$categoryQuery)->firstOrFail();
                $posts = $tag->posts()->where('category_id',$category->id)->simplePaginate($paginator);
                if($posts){
                    return $posts;
                }else{
                    return $posts;
                }
            }
            return $tag->posts()->simplePaginate($paginator);
        }elseif ($categoryQuery){
            $category = Category::where('slug',$categoryQuery)->firstOrFail();
            return Post::where('category_id',$category->id)->simplePaginate($paginator);
        }elseif ($searchQuery){
            return Post::where('title','like',"%{$searchQuery}%")->simplePaginate($paginator);
        }
        return Post::simplePaginate($paginator);
    }
}
