<?php

namespace App\Http\Controllers;

use App\Services\FollowerService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    protected $followerService , $userService;
    public function __construct(FollowerService $followerService,UserService $userService)
    {
        $this->middleware('auth')->except(['logout']);
        $this->followerService = $followerService;
        $this->userService = $userService;
    }
    /**
     * Follow
     *
     * @param $follow_id
     * @return \Illuminate\Http\Response json
     */
    public function follow($follow_id)
    {
        $newFollowing = $this->userService->getUserById($follow_id);
        $result = ['status'=>200];
        try{
            //follow
            $message = $this->followerService->follow($newFollowing);

            $result['message'] = $message;
        }catch(\Exception $e){
            $result = [
                'status'=>500,
                'error'=>$e->getMessage(),
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * UnFollow
     *
     * @param $follow_id
     * @return \Illuminate\Http\Response json
     */
    public function unFollow($follow_id)
    {
        $following = $this->userService->getUserById($follow_id);

        $result = ['status'=>200];
        try{
            //unfollow
            $message = $this->followerService->unFollow($following);

            $result['message'] = $message;
        }catch(\Exception $e){
            $result = [
                'status'=>500,
                'error'=>$e->getMessage(),
            ];
        }
        return response()->json($result, $result['status']);

    }

}
