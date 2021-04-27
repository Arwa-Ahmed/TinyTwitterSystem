<?php


namespace App\Services;


use App\Repositories\Contracts\TweetRepositoryInterface;
use Illuminate\Http\Request;
use Validator;

class TweetService
{
    protected $tweetRepositoryInterface;
    public function __construct(TweetRepositoryInterface $tweetRepositoryInterface){
        $this->tweetRepositoryInterface = $tweetRepositoryInterface;

    }
    /**
     * Get a validator for an incoming create tweet request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'tweet'=> 'required|max:140',
        ]);
    }
    /**
     * Format Tweet Data.
     *
     * @param  array  $data and $user_id
     * @return Array $tweetData
     */
    protected function formatTweetData(array $data,$user_id)
    {
        $tweetData =  [
            'user_id' => $user_id,
            'tweet' => $data['tweet'],
        ];
        return $tweetData;
    }

    /**
     * Create Tweet
     *
     * @param  Array $data and $user_id
     * @return Tweet $tweet
     */
    public function createTweet(array $data ,$user_id)
    {
        //validation
        $validator = $this->validator($data);
        if ($validator->fails())
        {
            //return response(['errors'=>$validator->errors()], 422);
            throw new \InvalidArgumentException($validator->errors());
        }

        //format tweet array
        $tweetData= $this->formatTweetData($data , $user_id);
        //create tweet
        $tweet = $this->tweetRepositoryInterface->createTweet($tweetData);

        return $tweet;
    }
    /**
     * Get all Tweets.
     *
     * @return \App\Tweet
     */
    public function getAllTweets(){
        return $this->tweetRepositoryInterface->getAllTweets();
    }

}
