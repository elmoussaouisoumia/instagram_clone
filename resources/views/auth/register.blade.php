@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-offset-8">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-center"><img width="70%"   src="{{ asset('img/logo 2.png') }}" ></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            

                            <div class="col-md-12">
                                <input id="email" type="email"  placeholder='e-mail'class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            

                            <div class="col-md-12">
                                <input id="nom_com" placeholder="Nom Complet" type="text" class="form-control @error('nom_com') is-invalid @enderror" name="nom_com" value="{{ old('nom_com') }}" required autocomplete="nom_com" autofocus>

                                @error('nom_com')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            

                            <div class="col-md-12">
                                <input id="nom_ut" placeholder="Nom Utilisateur" type="text" class="form-control @error('nom_ut') is-invalid @enderror" name="nom_ut" value="{{ old('nom_ut') }}" required autocomplete="nom_ut" autofocus>

                                @error('nom_ut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="form-group row">
                            

                            <div class="col-md-12">
                                <input id="password" type="password" placeholder='Mot de passe' class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" >
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
