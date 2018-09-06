@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-ml-auto">
            <div class="card bg-dark text-light">
                <div class="card-header">
                    <h3>Fiche élève 
                        <a href="{{ route('deleteEleve', $eleve->id) }}" style="float:right;"><button type="button" style="float:right;" class="btn btn-danger active"><span class="fa fa-trash" style="color:black;"></span></button></a>
                        <button type="button" style="float:right;" class="btn btn-warning active" data-toggle="modal" data-target="#myModal3"><span class="fa fa-pencil" style="color:black;"></span></button>
                    </h3>
                </div>

                <div class="card-body bg-light text-dark text-center cardDesign">
                    <img class="card-img-top" src="{{ asset('/images/profile.png') }}" alt="Card image" style="width: 20%">
                    <p class="lead">{{ $eleve->nom }} {{ $eleve->prenom }}, {{ $eleve->getAge() }} ans</p><hr>
                    <div class="row">
                        <div class="col-md-6 mr-auto">
                            <p>Sexe : {{ $eleve->sexe }} </p>
                            <p>Classe : {{ $eleve->getClasse()->nom }} </p>
                            @if($eleve->getClasse()->specialite == 'NULL')
                            <p>Specialité : ---- </p>
                            @else    
                            <p>Specialité : {{ $eleve->getClasse()->specialite }} </p>
                            @endif
                            <p>E-mail : {{ $eleve->mail }} </p>
                        </div>
                        <div class="col-md-6 ml-auto">
                            @if($eleve->sexe=='Masculin')
                                <p>Né le : {{ $eleve->dateNaissance }} </p>
                            @else
                                <p>Née le : {{ $eleve->dateNaissance }} </p>
                            @endif
                            <p>Filiere : {{ $eleve->getClasse()->filiere }} </p>
                            <p>Téléphone : {{ $eleve->tel }} </p>
                            <p>Adresse : {{ $eleve->adresse }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-mr-auto">
            <div class="card bg-dark text-light">
                <div class="card-header">
                    <h3>Bulletin de notes</h3>
                </div>
                <div class="card-body bg-light text-dark text-center cardDesign">
                    <table class="table table-bordered">
                        <thead>
                            <th class="text-center">Matière <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#myModal5"><span class="fa fa-plus" style="color:black;"></span></button></th>
                            <th class="text-center">Moyenne</th>
                            <th class="text-center">Note <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#myModal4"><span class="fa fa-plus" style="color:black;"></span></button></th>
                        </thead>
                        @foreach($matieres as $matiere)
                        <tbody>
                            <td>
                                <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#myModal{{ $matiere->id }}">{{ $matiere->nom }}</button>
                            </td>
                            <td>{{ $matiere->moy($eleve->id) }}</td>
                            <td>
                                @foreach($matiere->getNote($eleve->id) as $note)
                                <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#myModal{{ $matiere->id}}{{$note->id}}">{{ $note->note }} /20</button>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('graph', [$eleve->id, $matiere->id]) }}"><span class="fa fa-line-chart" style="color: blue;"></span></a>
                            </td> 
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModal3">
  <div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-dark text-light">
            <h4 class="modal-title">Edition de l'élève</h4>
            <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <form method="POST" action="{{ route('updateEleve', $eleve->id) }}" aria-label="{{ __('Edit élève') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nom" class="col-sm-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="nom" type="nom" class="form-control{{ $errors->has('nom') ? ' is-invalid' : '' }}" name="nom" value="{{ $eleve->nom }}" required autofocus>

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
                                <input id="prenom" type="prenom" class="form-control{{ $errors->has('prenom') ? ' is-invalid' : '' }}" name="prenom" value="{{ $eleve->prenom }}" required autofocu>

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
                                <input id="dateNaissance" type="dateNaissance" class="form-control{{ $errors->has('dateNaissance') ? ' is-invalid' : '' }}" name="dateNaissance" value="{{ $eleve->dateNaissance }}" required autofocus>

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
                                <input id="tel" type="tel" class="form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}" name="tel" value="{{ $eleve->tel }}" required autofocus>

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
                                <input id="adresse" type="adresse" class="form-control{{ $errors->has('adresse') ? ' is-invalid' : '' }}" name="adresse" value="{{ $eleve->adresse }}" required autofocus>

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
                                <input id="mail" type="mail" class="form-control{{ $errors->has('mail') ? ' is-invalid' : '' }}" name="mail" value="{{ $eleve->mail }}" required autofocus>

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
                                    <option value="{{ $eleve->getClasse()->id }}" selected> {{ $eleve->getClasse()->nom }} </option>
                                    @foreach($classes as $classe)
                                    <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-2 mx-auto">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Modifier') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer bg-dark">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModal4">
  <div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-dark text-light">
            <h4 class="modal-title">Ajout de note</h4>
            <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form method="POST" action="{{ route('addNote', $eleve->id) }}" aria-label="{{ __('Ajout de note') }}">
            {{ csrf_field() }}
                    <table class="table table-bordered">
                        <thead>
                            <th class="text-center">Matière</th>
                            <th class="text-center">Note</th>
                        </thead>
                        @foreach($matieres as $matiere)
                        <tbody>
                            <td>
                                <input id="id" name="id[]" type="hidden" value="{{ $matiere->id }}">{{ $matiere->nom }}
                            </td>
                            <td>
                                <input id="note" type="number" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note[]" min="0" max="20" value="{{ old('note') }}" style="width: 25%; float: right;">

                                @if ($errors->has('note'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tbody>
                        @endforeach
                    </table>
                <div class="form-group row mb-0">
                    <div class="col-lg-2 mx-auto">
                        <button type="submit" class="btn btn-success">
                            {{ __('Ajouter') }}
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

@foreach($matieres as $matiere)
    @foreach($matiere->getNote($eleve->id) as $note)

    <!-- The Modal -->
    <div class="modal fade" id="myModal{{$matiere->id}}{{$note->id}}">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-dark text-light">
                <h4 class="modal-title">Editer/Supprimer la note</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{ route('editNote', [$eleve->id, $note->id]) }}" aria-label="{{ __('Edition/Suppression de notes') }}">
                {{ csrf_field() }}
                        <table class="table table-bordered">
                            <thead>
                                <th class="text-center">Matière</th>
                                <th class="text-center">Note</th>
                            </thead>
                            <tbody>
                                <td>
                                    <input id="id" name="id[]" type="hidden" value="{{ $matiere->id }}">{{ $matiere->nom }}
                                </td>
                                <td>
                                    <input id="note" type="number" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note[]" min="0" max="20" value="{{ $note->note }}" style="width: 25%; float: right;">

                                    @if ($errors->has('note'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                    @endif
                                </td>
                            </tbody>
                        </table>
                    <div class="form-group row mb-0">
                        <div class="mx-auto">
                            <button type="submit" class="btn btn-success">{{ __('Editer') }}</button>
                            <a href="{{ route('deleteNote', [$eleve->id, $note->id]) }}" class="btn btn-danger" role="button">Supprimer</a>
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
    @endforeach
@endforeach

@foreach($matieres as $matiere)
<!-- The Modal -->
<div class="modal fade" id="myModal{{ $matiere->id }}">
  <div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-dark text-light">
            <h4 class="modal-title">Editer/Supprimer une matière</h4>
            <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form method="POST" action="{{ route('editMatiere', $matiere->id) }}" aria-label="{{ __('Editer/Supprimer une matière') }}">
            {{ csrf_field() }}
                <div class="form-group row">
                    <label for="matiere" class="col-md-4 col-form-label text-md-right">{{ __('Matière') }}</label>

                    <div class="col-md-6">
                        <input id="matiere" type="matiere" class="form-control{{ $errors->has('matiere') ? ' is-invalid' : '' }}" name="matiere" value="{{ $matiere->nom }}" required autofocus>

                        @if ($errors->has('matiere'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('matiere') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-success">{{ __('Editer') }}</button>
                        <a href="{{ route('deleteMatiere', $matiere->id) }}" class="btn btn-danger" role="button">Supprimer</a>
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
@endforeach

<!-- The Modal -->
<div class="modal fade" id="myModal5">
  <div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-dark text-light">
            <h4 class="modal-title">Ajout de matiéres</h4>
            <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form method="POST" action="{{ route('addMatiere') }}" aria-label="{{ __('Ajout de matière') }}">
            {{ csrf_field() }}
                <div class="form-group row">
                    <label for="matiere" class="col-md-4 col-form-label text-md-right">{{ __('Matière') }}</label>

                    <div class="col-md-6">
                        <input id="matiere" type="matiere" class="form-control{{ $errors->has('matiere') ? ' is-invalid' : '' }}" name="matiere" value="{{ old('matiere') }}" required autofocus>

                        @if ($errors->has('matiere'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('matiere') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-success">
                            {{ __('Ajouter') }}
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
@endsection