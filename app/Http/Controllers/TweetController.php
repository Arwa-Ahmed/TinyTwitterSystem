<?php

namespace App\Http\Controllers;

use App\Services\TweetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    protected $tweetService;
    public function __construct(TweetService $tweetService)
    {
        $this->middleware('auth')->except(['logout']);
        $this->tweetService = $tweetService;
    }
    /**
     * Show the form for creating a new tweet.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        $result = ['status'=>200];
        try{
            //create tweet
            $tweet = $this->tweetService->createTweet($data,$user_id);

            $result['data'] = $tweet;
        }catch(\Exception $e){
            $result = [
                'status'=>500,
                'error'=>$e->getMessage(),
            ];
        }
        return response()->json($result, $result['status']);
    }
}
