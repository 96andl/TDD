@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="/threads" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="title" id="title"
                           class="form-control {{$errors->first('title') ? 'alert-danger' : ''}}"
                           value="{{old('title')}}" required>
                    @if($errors->has('title'))
                        <div class="alert alert-danger">
                            <p>{{$errors->first('title')}}</p>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <textarea name="body" id="body" cols="30" rows="10"
                              class="form-control {{$errors->first('body') ? 'alert-danger' : ''}} " required>{{old('body')}}</textarea>
                    @if($errors->has('body'))
                        <div class="alert alert-danger">
                            <p>{{$errors->first('body')}}</p>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="channel">Channel</label>
                    <select name="channel_id" id="channel" class="form-control" required>
                        <option value="">Choose smth ....</option>
                        @foreach($channels as $channel)
                            <option value="{{$channel->id}}" {{old('channel_id') == $channel->id ? 'selected' : ''}}>{{$channel->name}}</option>
                        @endforeach
                    </select>

                </div>
                <button>Post</button>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

    </div>

@endsection
