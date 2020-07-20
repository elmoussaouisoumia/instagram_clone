<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

use App\Poste;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_com','nom_ut','num' ,'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function poste(){
       return $this->hasMany(Poste::class, "user_id");
    }


    public function follower(){
        return $this->belongsToMany(User::class,"user_follow","follower","followed");
    }


    public function followed(){
        return $this->belongsToMany(User::class,"user_follow","followed","follower");
    }


    public function isFollow($id)
    {
        $followers= Auth::user()->follower()->get();
        foreach($followers as $follower) {
            if($follower->id === $id) {
                return true;
            }
        }
        return false;
    }
    public function posts()
    {
       return $this->belongsToMany(Poste::class,'comments','user_id','post_id')->withTimestamps();
    }

    public function liked()
    {
       return $this->belongsToMany(Poste::class,'likes','user_id','post_id')->withTimestamps();
    }

    public function isLiked($id)
    {
        $likes= Auth::user()->liked()->get();
        foreach($likes as $like) {
            if($like->id === $id) {
                return true;
            }
        }
        return false;
    }
}
