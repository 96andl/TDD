<?php

    namespace App\Http\Controllers;

    use App\Channel;
    use App\Thread;
    use App\ThreadFilters\ThreadFilters;
    use App\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class ThreadsController extends Controller
    {

        /**
         * ThreadsController constructor.
         */
        public function __construct()
        {
            $this->middleware('auth')->only('create', 'store', 'edit', 'update', 'destroy');
        }


        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index($channelSlug = null, ThreadFilters $filter)
        {

            if ($channelSlug != null and !empty($channelSlug)) {
                $channel = Channel::where('slug', $channelSlug)->first();
            }
            if (isset($channel)) {
                $threads = Thread::where('channel_id', $channel->id)->with('channel')->latest();
            } else {
                $threads = Thread::with('channel');
            }
            $threads = $threads->filter($filter)->get();
            return view('threads.index', compact('threads'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('threads.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {

            $this->validate($request, [
                'channel_id' => 'exists:channels,id|numeric',
                'body'       => 'required',
                'title'      => 'required',
            ]);

            $thread = Thread::create([
                'user_id'    => Auth::user()->id,
                'channel_id' => $request->channel_id,
                'title'      => $request->title,
                'body'       => $request->body,
            ]);

            return redirect($thread->path);
        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Thread $thread
         * @return \Illuminate\Http\Response
         */
        public function show($channelId, Thread $thread)
        {
            return view('threads.show', compact('thread'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Thread $thread
         * @return \Illuminate\Http\Response
         */
        public function edit(Thread $thread)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \App\Thread $thread
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Thread $thread)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Thread $thread
         * @return \Illuminate\Http\Response
         */
        public function destroy(Thread $thread)
        {
            //
        }
    }
