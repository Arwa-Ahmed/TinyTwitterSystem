<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use App\Models\Tweet;
use App\Repositories\Contracts\TweetRepositoryInterface;

class TweetRepository implements TweetRepositoryInterface
{
    /**
     * Create a new tweet instance after a validate.
     *
     * @param  array  $data
     * @return \App\Tweet
     */
    public function createTweet(array $data){
            $tweet = new Tweet();
            $tweet->fill($data);
            $tweet->save();
            return $tweet;
    }

    /**
     * Get all Tweets.
     *
     * @return \App\Tweet
     */
    public function getAllTweets(){
        return Tweet::all();
    }

}
