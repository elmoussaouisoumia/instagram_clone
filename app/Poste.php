<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;
use DB;


class Poste extends Model
{
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

   public function users()
   {
      return $this->belongsToMany(User::class,'comments','user_id','post_id')->withTimestamps();
   }

   public function likes()
    {
       return $this->belongsToMany(User::class,'likes','user_id','post_id')->withTimestamps();
    }
    public function nbLikes($id)
    {
        $like = DB::table('likes')->where('post_id',$id);
        $nb_likes=$like->count();
        return $nb_likes;
    }
}
