<?php

namespace App\Http\Controllers;
use App\Poste;
use App\User;
use DB;
use Auth;

use Illuminate\Http\Request;

class PosteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $p = Poste::All();
        $u = User::All();
        
    

        $params = [ "post" => $p ,
                   "users" => $u ,
                
                    ];
        
        return view("postes.Poste")->with($params);
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
    public function store(Request $r)
    {
        $r->validate([
            'leg'=>'required',
            'file'=>'required',
            
        ]);
      $p=new Poste();
      $p->leg=$r->get("leg");
      $p->user_id = Auth::Id();
      if($r->file('file')) {
        $p->file=$r->file('file')->store('image','public');
       }
      $p->save();
      return redirect('/profil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = Poste::find($id);
        $p->user;
        $comments = DB::table('users')
        ->join('comments', 'users.id', '=', 'comments.user_id')
        ->where("post_id",$id)
        ->get();
        
        
        

        return view('postes.Show')->with([
            'post'=> $p,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $r->validate([
            'leg'=>'required',   
        ]);
        $p = Poste::find($id);
        $p->leg=$r->get("leg");
        $p->save();
        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Poste::find($id); 
        $p->delete();
        return redirect('/profil'); 
    }
    
    public function commentStore(Request $r)
    {
        Auth::User()->posts()->attach($r->get('id_post'));
        $comment = DB::table('comments')
            ->orderBy('id','desc')
            ->limit(1)
            ->update( ['contenu' => $r->get('contenu')]);
        return redirect()->back();
    }

    public function like($id){
        Auth::user()->liked()->toggle($id);
        // return redirect()->back();
        $like = DB::table('likes')->where('post_id',$id)->count();
        return $like;
    }
}
