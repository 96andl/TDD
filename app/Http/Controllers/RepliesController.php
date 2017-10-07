<?php

    namespace App\Http\Controllers;

    use App\Reply;
    use App\Thread;
    use Illuminate\Http\Request;

    class RepliesController extends Controller
    {

        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * @param Thread $thread
         * @param Request $request
         */

        public function store($channelslug = null ,Thread $thread)
        {
            $thread->addReply(

                ['body'    => request('body'),
                 'user_id' => auth()->user()->id,
                ]
            );
            return redirect()->back();
        }
    }
