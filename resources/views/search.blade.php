@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            @if(isset($details))
                <div class="card card bg-dark text-light">
                    <div class="card-header">
                        <h3>Résultat de la recherche</h3>
                    </div>

                    <div class="card-body bg-light text-dark text-center cardDesign">

                        <table class="table table-stripped">
                            <thead>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Prenom</th>
                                    <th class="text-center">Adresse e-mail</th>
                                    <th> </th> 
                            </thead>
                            @foreach($eleves as $eleve)
                                <tbody>
                                    <td>{{ $eleve->nom }}</td>
                                    <td>{{ $eleve->prenom }}</td>
                                    <td>{{ $eleve->mail }}</td> 
                                    <td>
                                        <a href="{{ route('detailsEleve', $eleve->id) }}">
                                            <button type="button" class="btn btn-dark btn-sm">Sélectionner</button>
                                        </a>
                                    </td> 
                                </tbody>
                            @endforeach
                        </table>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 col-mr-auto">
                                    <div id="chart-sexe"></div>
                                        @piechart('Sexe', 'chart-sexe')
                                </div>
                                <div class="col-md-4 col-mx-auto">
                                    <div id="chart-classe"></div>
                                        @barchart('Classe', 'chart-classe')             
                                </div>
                                <div class="col-md-4 col-ml-auto">
                                    <div id="chart-age"></div>
                                        @columnchart('Age', 'chart-age')             
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(isset($message))
                <div class="card card bg-dark text-light">
                    <div class="card-header">
                        <h3>Résultat de la recherche</h3>
                    </div>

                    <div class="card-body bg-light text-dark text-center cardDesign">
                        <p class="lead"> {{ $message }}
                    </div>
                </div>
            @endif
    	</div>
	</div>
</div>
@endsection