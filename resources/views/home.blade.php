@extends('layouts.app')
@section('content')
    <!-- Main Content -->
    <main class="main-content">
        <div class="section bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="row gap-y">
                            @if($posts && $posts->count() > 0)
                                @foreach($posts as $post)
                                    <div class="col-md-6 mb-2">
                                        <div class="card border mb-6 d-block post-card">
                                            <a href="{{route('posts.show',$post->slug)}}"><img class="card-img-top" src="{{asset('storage/'.$post->image)}}" alt="{{$post->title}}"></a>
                                            <div class="p-6  text-center">
                                                <p><a class="small text-lighter text-uppercase text-secondary" href="
                                                    @if(request()->query('tag'))
                                                    {{route('home',['category='.$post->category->slug,'tag='.request()->query('tag')])}}
                                                    @else
                                                    {{route('home',['category='.$post->category->slug])}}
                                                    @endif">{{$post->category->name}}</a></p>
                                                <div class="d-flex justify-content-center">
                                                    @foreach($post->tags as $tag)
                                                    <span class="badge badge-dark">{{$tag->name}}</span>
                                                    @endforeach
                                                </div>
                                                <h5 class="mb-0"><a class="text-dark" href="{{route('posts.show',$post->slug)}}">{{$post->description}}</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h1>No Post Was Found.</h1>
                            @endif
                        </div>
                        <nav class="flexbox mt-2">
                            @if($posts)
                            {{$posts->appends(['tag'=>request()->query('tag'),'category'=>request()->query('category'),'search'=>request()->query('search')])->links()}}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@section('sidebar')
    <form class="form-group input-group" method="GET">
        <input type="text" class="form-control bg-light border-1 small" name="search" placeholder="Search">
        <div class="input-group-append">
            <button type="submit"class="btn btn-primary" ><i class="fas fa-search fa-sm"></i></button>
        </div>
    </form>
    <hr>
    <h6 class="sidebar-title">Categories</h6>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-6"><a class="" href="
                @if(request()->query('tag'))
                {{route('home',['category='.$category->slug,'tag='.request()->query('tag')])}}
                @else
                {{route('home',['category='.$category->slug])}}
                @endif
                    ">{{$category->name}}</a></div>
        @endforeach
    </div>
    <hr>
    <h6 class="sidebar-title">Tags</h6>
    <div class="gap-multiline-items-1">
        @foreach($tags as $tag)
            <a class="badge badge-secondary" href="{{route('home','tag='.$tag->slug)}}">{{$tag->name}}</a>
        @endforeach
    </div>
    @auth()
        <hr>
        <a class="btn btn-outline-primary d-flex justify-content-center" href="{{route('posts.create')}}">Create New Post</a>
        <ul class="list-group mt-2">
            <li class="list-group-item" ><a href="{{route('user.posts')}}">My Posts</a></li>
            <li class="list-group-item" ><a href="{{route('user.posts.trashed')}}">My Trashed Posts</a></li>
        </ul>
    @endauth
    <hr>

@endsection
