<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_date',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Get the tweets for the user.
     */
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * Get a list of users following us
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'follow_id', 'user_id');
    }

    /**
     * Get all users you are following
     */
    public function following()
    {
       return $this->belongsToMany(User::class, 'followers', 'user_id', 'follow_id');
    }
    /**
     * Check if user is already following
     */
    public function isFollowing($follow_id){
        $following = $this->following()->where('follow_id',$follow_id)->first();
        return $following;
    }
    /**
     * format user
     */
    public function format(){
        return [
            'name' => $this->name,
            'email' => $this->email,
            'birth_date'=>$this->birth_date,
            'image'=> $this->image,
        ];
    }

}
