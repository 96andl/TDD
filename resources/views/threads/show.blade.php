@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$thread->title}}</div>

                    <div class="panel-body">
                        <h4><a href="">{{$thread->creator_name}}</a></h4>
                        <article>
                            {{$thread->body}}
                        </article>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @foreach($thread->replies as $reply)
                        <div class="panel-body">
                            <div class="panel-heading">{{$reply->owner->name}}
                                said {{$reply->created_at->diffForHumans()}}</div>
                            <article>
                                {{$reply->body}}
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if(auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form action="{{$thread->path .'/replies'}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea name="body" id="body" placeholder="Have something to say?" class="form-control"></textarea>
                        </div>
                        <button>Post</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="{{route('login')}}">signIn</a> to participate in this discussion</p>
        @endif
    </div>
@endsection
