<?php


namespace App\Repositories;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function createUser(array $data){
            $newUser = new User();
            $newUser->fill($data);
            $newUser->save();
            return $newUser;
    }
    /**
     * Get user by id
     *
     * @param $id
     * @return App\User $user
     */
    public function getUserById($id){
       return User::where('id',$id)->first();
    }
    /**
     * Get all user.
     *
     * @return \App\User
     */
    public function getAllUser(){
        return User::all();
    }
}
