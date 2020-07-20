@extends('layout')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">


                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <header>



                        <div class="profile">

                            <div class="profile-image">
                                @if($user->pdp==NULL)
                                <i class="fa fa-user-circle-o " style="font-size:200px;color:#C0C0C0"></i>
                                @else
                                <img src="{{asset('storage/'.$user->pdp )}}">
                                @endif
                            </div>

                            <div class="profile-user-settings">

                                <h1 class="profile-user-name">{{ $user->nom_ut }} </h1>
                                @if($user->id == Auth::user()->id)
                                <a href="{{route('profil.edit',$user->id)}}" class="btn profile-edit-btn">Edit
                                    Profil</a>

                                <button class="btn profile-edit-btn" data-toggle="modal" data-target="#add">Add
                                    Post</button>
                                @else
                                    @if(!Auth::user()->isFollow ($user->id))
                                        <a href="{{ url('follow/'.$user->id)}}" class="btn profile-edit-btn"> S'abonner</a>
                                    @else
                                        <a href="{{ url('follow/'.$user->id)}}" class="btn profile-edit-btn"> Se desabonner</a>
                                    @endif
                                @endif
                                <div class="modal fade " id="add" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h5 class="modal-title myFontSize" id="exampleModalLabel">Add Post</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body d-flex justify-content-center">
                                                <form method="POST" action="{{ route('poste.store') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group row">
                                                        <label for="leg"
                                                            class="myFontSize col-form-label col-4">Légende:</label>
                                                        <textarea class="myFontSize form-control col-6"
                                                            name="leg"></textarea>
                                                    </div>
                                                    <div class=" form-group row">

                                                        <label for="file"
                                                            class=" myFontSize col-form-label col-3">File:</label>
                                                        <input type="file" class="myFontSize form-control col-7"
                                                            name="file" />

                                                    </div>
                                                    <button type="button" class="btn btn-secondary myFontSize"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit"
                                                        class="btn btn-primary myFontSize">add</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <div class="profile-stats">

                                <ul>
                                    <li><span class="profile-stat-count">{{ $nb_pub }}</span> posts</li>
                                    <li><span class="profile-stat-count">{{ $nb_followers }}</span> followers</li>
                                    <li><span class="profile-stat-count">{{ $nb_followed }}</span> following</li>
                                </ul>

                            </div>

                            <div class="profile-bio">

                                <p><span class="profile-real-name">{{ $user->nom_com }} </span>
                                    {{ $user->bio}} </p>

                            </div>

                        </div>



                        <!-- End of container -->

                    </header>
                </div>
            </div>
            <div class=" mt-4">
                <div class="gallery">
                    @foreach( $posts as $post)
                    <div class="gallery-item" tabindex="0">

                        <a href="{{route('poste.show',$post->id)}}"> <img src="{{asset('storage/'.$post->file)}}"
                                class="gallery-image" alt=""></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
