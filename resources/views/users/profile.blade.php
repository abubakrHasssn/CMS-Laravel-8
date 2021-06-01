@extends('layouts/app')
@section('content')
    @include('partials/errors')
    <div class="row gutters-sm mb-2">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{asset('storage/'.$user->avatar)}}" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4>{{$user->username}}</h4>
                            <p class="text-secondary mb-1">{{$user->role_name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$user->name}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$user->email}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Role</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$user->role_name}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">About</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$user->about}}
                        </div>
                    </div>
                </div>
            </div>
            @if(auth()->user()->id === $user->id)
                <a class="btn btn-primary d-flex justify-content-center" href="{{route('settings')}}">Edit Profile</a>
            @endif
        </div>
    </div>
    @if($user->hasPosts())
        <div id="accordion">
            @foreach($user->posts()->simplePaginate(6) as $post)
                <div class="[ card ] card-google-plus mt-4" >
                    <div class="card-header " id="{{'HeadingNo'.$post->id}}">
                        <div class="d-flex justify-content-between collapsed" data-toggle="collapse" data-target="#{{'CollapseNo'.$post->id}}" aria-expanded="false" aria-controls="{{'CollapseNo'.$post->id}}">
                            <div class="d-inline-flex">
                                <img class="img-circle img-fluid" src="{{asset('storage/'.$user->avatar)}}" alt="UserImage" style="width: 60px" />
                                <h5 class="ml-2 mt-3 text-color-gray">{{$user->name}}</h5>
                            </div>
                            <div class="text-color-gray">
                            </div>
                            <div class="mt-3">
                                <span>Published At</span> - <span>{{$post->published_at}}</span>
                            </div>
                        </div>
                    </div>
                    <div id="{{'CollapseNo'.$post->id}}" class="collapse show" aria-labelledby="{{'HeadingNo'.$post->id}}" data-parent="#accordion">
                        <div class="card-body">
                            <a href="{{route('posts.show',$post->slug)}}"><h4 class="text-color-gray">{{$post->title}}</h4></a>
                            @if(strlen($post->contents) > 250)
                            <p>{!! substr($post->contents,0,250)  !!} <a href="{{route('posts.show',$post->slug)}}">Read More...</a></p>
                            @else
                                <p>{!! $post->contents !!}</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-control">Add a comment...</div>
                    </div>
                    <div class="card-google-plus-comment">
                        <img class="img-circle" src="{{asset('storage/'.auth()->user()->avatar)}}" alt="User Image" width="40" />
                            <form action="{{route('comments.store',$post->slug)}}" method="post">
                                @csrf
                                <div class="card-google-plus-textarea">
                                    <textarea class="form-control" name="content" rows="4"></textarea>
                                    <button type="submit" class="[ btn btn-success disabled ]">Post comment</button>
                                    <button type="reset" class="[ btn btn-default ]">Cancel</button>
                                </div>
                            </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{$user->posts()->simplePaginate(6)->links()}}
        </div>
    @else
        <h1 class="text-color-gray text-center mt-5">No posts</h1>
    @endif
@endsection
@section('scripts')
    <script>
        $(function () {
            $('.card-google-plus > .card-footer > .form-control, .card-google-plus > .card-google-plus-comment > form > .card-google-plus-textarea > button[type="reset"]').on('click', function(event) {
                var $card = $(this).closest('.card-google-plus');
                $comment = $card.find('.card-google-plus-comment');

                $comment.find('.btn:first-child').addClass('disabled');
                $comment.find('textarea').val('');

                $card.toggleClass('card-google-plus-show-comment');

                if ($card.hasClass('card-google-plus-show-comment')) {
                    $comment.find('textarea').focus();
                }
            });
            $('.card-google-plus-comment > form > .card-google-plus-textarea > textarea').on('keyup', function(event) {
                var $comment = $(this).closest('.card-google-plus-comment');

                $comment.find('button[type="submit"]').addClass('disabled');
                if ($(this).val().length >= 1) {
                    $comment.find('button[type="submit"]').removeClass('disabled');
                }
            });
        });
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endsection
