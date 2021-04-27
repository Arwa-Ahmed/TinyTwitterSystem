<?php


namespace App\Services;
use Illuminate\Support\Facades\Auth;

class FollowerService
{
    /**
     * follow
     *
     * @param App\User $newFollowing
     * @return String
     */
    public function follow($newFollowing)
    {
        //check if exists
        if(!$newFollowing || (Auth::user()->id == $newFollowing->id)){
            throw new \Exception("User Is Not Found");
        }
        //check if already following
        $following = Auth::user()->isFollowing($newFollowing->id);
        if($following){
            throw new \Exception("Already Following");
        }
        //follow
        Auth::user()->following()->attach($newFollowing);
        return 'Following Successfully';
    }

    /**
     *unfollow
     * @param App\User $following
     * @return String
     */
    public function unfollow($following)
    {
        //check if exists
        if(!$following || (Auth::user()->id == $following->id)){
            throw new \Exception('User Is Not Found');
        }
        //check if already not following
        $following = Auth::user()->isFollowing($following->id);
        if(!$following){
            throw new \Exception('Not Following');
        }
        //unfollow
        Auth::user()->following()->detach($following);
        return 'Unfollowing Successfully';
    }
}
