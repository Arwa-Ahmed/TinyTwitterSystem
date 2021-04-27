<?php

namespace App\Repositories\Contracts;

interface TweetRepositoryInterface
{
    /**
     * Create a new tweet instance after a validate.
     *
     * @param array $data
     * @return \App\Tweet
     */
    public function createTweet(array $data);
    /**
     * Get all Tweets.
     *
     * @return \App\Tweet
     */
    public function getAllTweets();
}
