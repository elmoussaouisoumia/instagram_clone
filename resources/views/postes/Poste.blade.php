@extends('layout')

@section('content')
<div class='row w-100'>
    <div class="col-6 ml-4">
        @foreach($post as $post)
        <div class="myFontSize card col-10 offset-3 mb-3">
            <div class="card-head d-flex justify-content-start">
                <div class="col-2 mt-2">
                    @if($post->user->pdp==NULL)
                    <i class="fa fa-user-circle-o " style="font-size:60px;color:#C0C0C0"></i>
                    @else
                    <img src="{{asset('storage/'.$post->user->pdp)}}" class="rounded-circle rounded-sm " style="width:40px;height:40px">
                    @endif
                </div>
                <p class="card-text align-self-center h3 text-primary mt-2">{{$post->user->nom_ut }}</p>
            </div>
            <hr />
            <a href="{{route('poste.show',$post->id)}}"><img src="{{asset('storage/'.$post->file)}}"
                    class="card-img-top w-100 pt-1" height="auto"></a>
            <div class="card-body">
            <div>
            
            <!-- @if(!Auth::user()->isLiked ($post->id))
            
            <a href="{{ url('like/'.$post->id)}}"><i class="fa fa-heart-o mx-2" style="font-size:25px "></i></a>
            @else
            <a href="{{ url('like/'.$post->id)}}"><i class="fa fa-heart" style="font-size:25px;color:red"></i></a>
            @endif -->
            <p id="nbreLikesPost{{ $post->id }}">{{ $post->nbLikes($post->id) }}</p>
            
            <a  onClick="like({{ $post->id }});">
                <i id="myIcon{{ $post->id }}"
                  class="fa  mx-2 @if(!Auth::user()->isLiked($post->id)) fa-heart-o @else fa-heart @endif" 
                  style="font-size:25px; @if(Auth::user()->isLiked($post->id)) color:red;  @endif" 
                >
                </i>
            </a>

            <a href="{{route('poste.show',$post->id)}}" ><i class="fa fa-comment-o " style="font-size:25px"></i></a>
            </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="card-text"><span class="font-weight-bold text-primary">{{$post->user->nom_ut  }}
                            </span>{{$post->leg}}</p>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    <div class="col-3  offset-2" style="margin-right:2%;">
        <div class="card position-fixed col-3 ">
        <p class="text-muted myFontSize ">Suggestions pour vous</p>
            @foreach($users as $user)
            
            <div class=" row mb-2">
            
            @if($user->id != Auth::user()->id)
            @if(!Auth::user()->isFollow ($user->id))
            @if($user->pdp==NULL)
            <i class="fa fa-user-circle-o ml-4" style="font-size:40px;color:#C0C0C0"></i>
            @else
                <img src="{{asset('storage/'.$user->pdp)}}"class="rounded-circle rounded-sm ml-4 "style="width:40px;height:40px" >
            @endif
                <a href="{{ url('profil/'.$user->id)}}"><p class="card-text align-self-center h3 text-primary mt-2 ml-5">{{$user->nom_ut }}</p></a>
                <a href="{{ url('follow/'.$user->id)}}" class="mr-4 mt-2 myFontSize ml-auto">S'abonner</a>
                
            @endif
            @endif
            
           </div>
           
            @endforeach
        </div>
    </div>
</div>
@endsection
