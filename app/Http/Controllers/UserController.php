<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {   
        $p=Auth::user()->poste()->get();
        $nb_pub = $p->count();
        $user=Auth::User();
        $u=$user->follower()->get();
        $nb_followers=$u->count();
        $us=$user->followed()->get();
        $nb_followed=$us->count();


        return view("users.profil")->with([
            "posts" => $p,
            "nb_pub" => $nb_pub,
            "user" => $user,
            "nb_followers" => $nb_followers,
            "nb_followed" => $nb_followed,
        ]);
    }

    public function otherIndex($id)
    {
        if(User::find($id) !== null && User::find($id) !== Auth::user()) {
            $user = User::findOrFail($id);
            $p = $user->poste()->get();
            $nb_pub = $p->count();
            $u=Auth::user()->follower()->get();
            $nb_followers=$u->count();
            $us=Auth::user()->followed()->get();
            $nb_followed=$us->count();
            
        } else {
            return redirect('/poste');
        }
        

        return view("users.profil")->with([
            "posts" => $p,
            "nb_pub" => $nb_pub,
            "user" => $user,
            "nb_followers" => $nb_followers,
            "nb_followed"  => $nb_followed,
            
        ]);
    }

    public function follow($id){
        Auth::user()->follower()->toggle($id);

        return $this->otherIndex($id);
    }
   

    

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user=Auth::user();
      return view('users.editProfil')->with("profil",$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $user=Auth::user();
        $user->nom_com=$r->get('nom_com');
        $user->nom_ut=$r->get('nom_ut');
        $user->bio=$r->get('bio');
        $user->email=$r->get('email');
        $user->num=$r->get('num');
        $user->genre=$r->get('genre');
        if($r->file('pdp')) {
            $user->pdp=$r->file('pdp')->store('image','public');
           }
        if(!$r->get('password')){
            $user->password=Auth::user()->password;
        }
        else
        {
            $user->password=Hash::make($r->get('password'));
        }
        
        $user->save();
        
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
