@extends('layout')
@section('content')
<div class="container">
    <div class="myFontSize row justify-content-center">
        <div class="col-12 mt-5">
            <div class="card col-9 offset-1 ">
                <div class="profile-image row">
                @if(Auth::user()->pdp==NULL)
            <i class="fa fa-user-circle-o ml-2" style="font-size:80px;color:#C0C0C0"></i>
            @else
                <img src="{{asset('storage/'.Auth::user()->pdp)}}"class="col-4">
            @endif
                    
                    <h1 class="col-8" style="color:blue">{{Auth::user()->nom_ut}}</h1>
                </div>
                
                <form class="offset-1 mt-4 mb-4" method="post" action="{{ route('profil.update', Auth::User()->id) }}"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="form-group row">

                        <label for="nom_com" class=" myFontSize col-form-label col-3">Nom
                            Complet:</label>
                        <input type="text" class="myFontSize form-control col-7" name="nom_com"
                            value="{{Auth::user()->nom_com}}" />
                    </div>

                    <div class="form-group row">
                        <label for="nom_ut" class="myFontSize col-form-label col-3">Nom
                            Utilisateur:</label>
                        <input type="text" class="myFontSize form-control col-7" name="nom_ut"
                            value="{{ Auth::user()->nom_ut}}" />
                    </div>

                    <div class="form-group row">
                        <label for="email" class="myFontSize col-form-label col-3">Email:</label>
                        <input type="text" class="myFontSize form-control col-7" name="email"
                            value="{{ Auth::user()->email}}" />
                    </div>
                    <div class="form-group row">
                        <label for="bio" class="myFontSize col-form-label col-3">Biographie:</label>
                        <textarea class="myFontSize form-control col-7" name="bio">{{Auth::user()->bio}}</textarea>
                    </div>
                    <div class="form-group row">
                        <label for="num" class="myFontSize col-form-label col-3">Numéro de
                            Téléphone:</label>
                        <input type="text" class="myFontSize align-self-center form-control col-7" name="num"
                            value="{{Auth::user()->num}}" />
                    </div>
                    <div class=" form-group row">

<label for="pdp" class=" myFontSize col-form-label col-3">Image:</label>
<input type="file" class="myFontSize form-control col-7" name="pdp" />
@if(Auth::user()->pdp==NULL)
            <i class="fa fa-user-circle-o ml-2" style="font-size:40px;color:#C0C0C0"></i>
            @else
                <img src="{{asset('storage/'.Auth::user()->pdp)}}"class="rounded-circle rounded-sm " style="width:40px;height:40px">
            @endif

</div>
<div class="form-group row"> <label for="genre" class=" myFontSize col-form-label col-3">Sexe:</label>
<select class="myFontSize form-control col-7"  name="genre" >
    @if(Auth::User()->genre == 'Homme')
    <option value="Homme" selected>Homme</option>
    <option value="Femme">Femme</option>
    @else
    <option value="Homme">Homme</option>
    <option value="Femme" selected>Femme</option>
    @endif
</select>


</div>
                       <div class="form-group row">
                        <label for="password" class="myFontSize col-form-label col-3">Password:</label>
                        <input type="password" class="myFontSize form-control col-7" name="password" />
                    </div>
                    <button type="submit" class="myFontSize btn btn-primary col-3 offset-4 ">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
