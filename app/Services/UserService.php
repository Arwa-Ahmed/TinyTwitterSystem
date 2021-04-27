<?php


namespace App\Services;


use App\Repositories\Contracts\UserRepositoryInterface;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepositoryInterface;
    protected $fileService;
    public function __construct(UserRepositoryInterface $userRepositoryInterface , FileService $fileService){
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->fileService = $fileService;

    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name'=> 'required',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
            'birth_date'=>'required',
            'image' =>'image|mimes:jpeg,png,jpg,gif,svg|required'
        ]);
    }
    /**
     * Format User Data.
     *
     * @param  array  $data and image
     * @return Array $userData
     */
    protected function formatUserData(array $data,$image)
    {
        //upload image
        $path =public_path().'/uploads/profileImage';
        $imageName = $this->fileService->UploadImage($image,$path);
        $userData =  [
            'name' => $data['name'],
            'email' => $data['email'],
            'birth_date' => $data['birth_date'],
            'password' => Hash::make($data['password']),
            'image' => $imageName,
        ];
        return $userData;
    }

    /**
     * User Registration
     *
     * @param  Array $data
     * @return App\User  $user
     */
    public function registerUser(array $data ,$image)
    {
        //validation
        $validator = $this->validator($data);

        if ($validator->fails())
        {
            throw new \InvalidArgumentException($validator->errors());
        }
        //format user array
        $userData= $this->formatUserData($data , $image);

        //create user
        $user = $this->userRepositoryInterface->createUser($userData);

        return $user;
    }
    /**
     * Get user by id
     *
     * @param $id
     * @return App\User $user
     */
    public function getUserById($id)
    {
        return $this->userRepositoryInterface->getUserById($id);
    }

    /**
     * Get All user
     *
     * @return App\User
     */
    public function getAllUser()
    {
        return $this->userRepositoryInterface->getAllUser();
    }
}
