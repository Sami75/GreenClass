@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card bg-light text-dark">
                <div class="card-header">
                    <h3>Evolution des notes de {{ $matiere->nom }}</h3>
                </div>

                <div class="card-body text-center cardDesign">
                    <div id="chart-div"></div>
                    {!! $lava->render('LineChart', 'Evolution', 'chart-div') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection