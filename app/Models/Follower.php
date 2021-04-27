<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'follow_id',
    ];
    public function user(){
       return $this->belongsTo(User::class);
    }
    public function follower()
    {
        return $this->hasOne(User::class, 'follow_id', 'id');
    }
}
