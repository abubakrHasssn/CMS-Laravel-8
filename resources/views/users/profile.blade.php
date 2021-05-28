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
{{--            <div class="card mt-3">--}}
{{--                <ul class="list-group list-group-flush">--}}
{{--                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">--}}
{{--                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>--}}
{{--                        <span class="text-secondary">https://my-blog.com</span>--}}
{{--                    </li>--}}
{{--                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">--}}
{{--                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>--}}
{{--                        <span class="text-secondary">Username</span>--}}
{{--                    </li>--}}
{{--                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">--}}
{{--                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>--}}
{{--                        <span class="text-secondary">@username</span>--}}
{{--                    </li>--}}
{{--                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">--}}
{{--                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>--}}
{{--                        <span class="text-secondary">@username</span>--}}
{{--                    </li>--}}
{{--                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">--}}
{{--                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>--}}
{{--                        <span class="text-secondary">@username</span>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
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
