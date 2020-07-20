@extends('layout')

@section('content')

<div class="myFontSize card col-6 offset-3">
    <div class="card-head d-flex bd-highlight">
        <div class="col-2 mt-2">
            @if($post->user->pdp==NULL)
            <i class="fa fa-user-circle-o " style="font-size:80px;color:#C0C0C0"></i>
            @else
            <img src="{{asset('storage/'.$post->user->pdp)}}" class="rounded-circle rounded-sm "
                style="width:40px;height:40px">
            @endif
        </div>
        <p class="card-text align-self-center h3 text-primary mt-2">{{$post->user->nom_ut }}</p>
        @if($post->user->id==Auth::user()->id)
        <i class="fa fa-ellipsis-v mt-4 ml-auto" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" style="font-size:24px;"></i>
        <div class="myFontSize dropdown-menu dropright" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item" type="button" data-toggle="modal"
                data-target="#update{{$post->id}}">Modifier</button>
            <button type="button" class="dropdown-item" data-toggle="modal"
                data-target="#delete{{$post->id}}">Supprimer</button>
        </div>
        @endif
        <div class="modal fade" id="update{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-muted myFontSize" id="exampleModalLabel">Update Post</h5>
                        <button type="button" class="close myFontSize" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <form action="{{ route('poste.update',$post->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <img src="{{asset('storage/'.$post->file)}}" class="col-12 mb-2" width="400px"
                                height="auto">
                            <div class="form-group row ">
                                <label for="leg" class="myFontSize col-form-label col-3">Légende:</label>
                                <textarea class="myFontSize form-control col-8" name="leg">{{$post->leg}}</textarea>
                            </div>



                            <button type="button" class="btn btn-secondary myFontSize"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary myFontSize">update</button>
                        </form>

                    </div>

                </div>
            </div>

        </div>
        <div class="modal fade" id="delete{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title myFontSize" id="exampleModalLabel">Delete Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('poste.destroy', $post->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <p>Are you sure?</p>
                            <button type="button" class="btn btn-secondary myFontSize" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary myFontSize">Yes</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <hr />
    <img src="{{asset('storage/'.$post->file)}}" class="card-img-top w-100 pt-1" height="auto">

    <div class="card-body">
        <div>
        <p id="nbreLikesPost{{ $post->id }}">{{ $post->nbLikes($post->id) }}</p>
        <a  onClick="like({{ $post->id }});">
                <i id="myIcon{{ $post->id }}"
                  class="fa  mx-2 @if(!Auth::user()->isLiked($post->id)) fa-heart-o @else fa-heart @endif" 
                  style="font-size:25px; @if(Auth::user()->isLiked($post->id)) color:red;  @endif" 
                >
                </i>
            </a> 
            
            <i class="fa fa-comment-o " style="font-size:25px"></i>
            </div>

        <div class="d-flex justify-content-between">

            <div>
                <p class="card-text"><span class="font-weight-bold text-primary">{{$post->user->nom_ut  }}
                    </span>{{$post->leg}}</p>
            </div>

        </div>
        @foreach($comments as $comment)
        <div>
        <p class="card-text"><span class="font-weight-bold ">{{$comment->nom_ut}}
        </span>{{$comment->contenu}}</p>
         
        </div>
        @endforeach
        <form method='post' action="{{ route('comment') }}" class="">
            @csrf
            <div class="form-group row d-flex justify-content-center">
                <textarea name="contenu" id="" cols="70" rows="1" class=" col-8 form-control"></textarea>
                <input type="hidden" name="id_post" value="{{ $post->id }}">
                <button type="submit" class="btn btn-primary myFontSize ml-2">comment</button>
            </div>
            
        </form>
    </div>
</div>
@endsection
