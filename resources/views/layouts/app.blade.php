<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GreenClass') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}"  rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <nav class="navbar bg-dark navbar-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ 'GreenClass' }}
                </a>
                <div class="ml-auto">
                    <form action="{{ route('search') }}" method="POST" role="search">
                    {{ csrf_field() }}
                        <div class="input-group">
                            <input id="search" type="search" class="form-control{{ $errors->has('search') ? ' is-invalid' : '' }}" name="search" placeholder="Rechercher un élève" required>
                                <button type="submit" class="btn btn-light">
                                    <span class="fa fa-search bg-light"></span>
                                </button>
                        </div>
                    </form>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal">{{ __("Création d'une classe") }}</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal2">{{ __("Création d'un élève") }}</button>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @include('flash-message')
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header bg-dark text-light">
            <h4 class="modal-title">Création d'une classe</h4>
            <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form method="POST" action="{{ route('creationClasse') }}" aria-label="{{ __('Classe') }}">
                @csrf

                <div class="form-group row">
                    <label for="nom" class="col-sm-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                    <div class="col-md-6">
                        <input id="nom" type="nom" class="form-control{{ $errors->has('nom') ? ' is-invalid' : '' }}" name="nom" value="{{ old('nom') }}" required autofocus>

                        @if ($errors->has('nom'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nom') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="filiere" class="col-md-4 col-form-label text-md-right">{{ __('Filiere') }}</label>

                    <div class="col-md-6">
                        <input id="filiere" type="filiere" class="form-control{{ $errors->has('filiere') ? ' is-invalid' : '' }}" name="filiere" required>

                        @if ($errors->has('filiere'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('filiere') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="specialite" class="col-md-4 col-form-label text-md-right">{{ __('Spécialité') }}</label>

                    <div class="col-md-6">
                        <input id="specialite" type="specialite" class="form-control{{ $errors->has('specialite') ? ' is-invalid' : '' }}" name="specialite" required>

                        @if ($errors->has('specialite'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('specialite') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="taille" class="col-md-4 col-form-label text-md-right">{{ __('Taille') }}</label>

                    <div class="col-md-6">
                        <input id="taille" type="taille" class="form-control{{ $errors->has('taille') ? ' is-invalid' : '' }}" name="taille" required>

                        @if ($errors->has('taille'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('taille') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-2 mx-auto">
                        <button type="submit" class="btn btn-success">
                            {{ __('Créer') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

          <!-- Modal footer -->
          <div class="modal-footer bg-dark">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          </div>

        </div>
      </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal2">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header bg-dark text-light">
            <h4 class="modal-title">Création d'un élève</h4>
            <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form method="POST" action="{{ route('creationEleve') }}" aria-label="{{ __('Eleve') }}">
                @csrf

                <div class="form-group row">
                    <label for="nom" class="col-sm-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                    <div class="col-md-6">
                        <input id="nom" type="nom" class="form-control{{ $errors->has('nom') ? ' is-invalid' : '' }}" name="nom" value="{{ old('nom') }}" required autofocus>

                        @if ($errors->has('nom'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nom') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="prenom" class="col-md-4 col-form-label text-md-right">{{ __('Prenom') }}</label>

                    <div class="col-md-6">
                        <input id="prenom" type="prenom" class="form-control{{ $errors->has('prenom') ? ' is-invalid' : '' }}" name="prenom" required>

                        @if ($errors->has('prenom'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('prenom') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dateNaissance" class="col-md-4 col-form-label text-md-right">{{ __('Date de Naissance') }}</label>

                    <div class="col-md-6">
                        <input id="dateNaissance" type="dateNaissance" class="form-control{{ $errors->has('dateNaissance') ? ' is-invalid' : '' }}" name="dateNaissance" required>

                        @if ($errors->has('dateNaissance'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('dateNaissance') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sexe" class="col-md-4 col-form-label text-md-right">{{ __('Sexe') }}</label>
                    <div class="col-md-6">
                        <div class="radio-inline">
                            <input class="radio" type="radio" name="sexe" value ="Féminin" id="sexe" {{ old('sexe') ? 'checked' : '' }}>

                            <label class="radio-inline" for="sexe">
                                {{ __('Féminin') }}
                            </label>
                            <input class="radio" type="radio" name="sexe" value ="Masculin" id="sexe" {{ old('sexe') ? 'checked' : '' }}>
                            <label class="radio-inline" for="sexe">
                                {{ __('Masculin') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Téléphone') }}</label>

                    <div class="col-md-6">
                        <input id="tel" type="tel" class="form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}" name="tel" required>

                        @if ($errors->has('tel'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tel') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="adresse" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                    <div class="col-md-6">
                        <input id="adresse" type="adresse" class="form-control{{ $errors->has('adresse') ? ' is-invalid' : '' }}" name="adresse" required>

                        @if ($errors->has('adresse'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('adresse') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="mail" class="col-md-4 col-form-label text-md-right">{{ __('Adresse mail') }}</label>

                    <div class="col-md-6">
                        <input id="mail" type="mail" class="form-control{{ $errors->has('mail') ? ' is-invalid' : '' }}" name="mail" required>

                        @if ($errors->has('mail'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mail') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="classe" class="col-md-4 col-form-label text-md-right">{{ __('Sélectionner une classe') }}</label>
                    <div class="col-md-6">
                        <select class="form-control" name ="classe" id="classe">
                            <option disabled selected> -- Sélectionner une classe -- </option>
                            @foreach($classes as $classe)
                            <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-2 mx-auto">
                        <button type="submit" class="btn btn-success">
                            {{ __('Créer') }}
                        </button>
                    </div>
                </div>
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer bg-dark">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          </div>

        </div>
      </div>
    </div>
</body>
</html>