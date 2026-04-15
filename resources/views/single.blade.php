@extends('layouts.app')

@section('title', 'Trajet • CovoitPro')

@section('content')
<div class="site-section">
    <div class="container">
        <div class="row align-items-center justify-content-between mb-5">
            <div class="col-lg-7">
                <h1 class="mb-3">{{ $trajet->depart }} <span class="text-primary">→</span> {{ $trajet->destination }}</h1>
                <p class="lead text-muted mb-4">Proposé par {{ $trajet->conducteur->name ?? 'Un conducteur' }} le {{ optional($trajet->date)->format('d F Y') }} à {{ $trajet->heure }}</p>
                <p>Ce trajet est disponible pour les passagers souhaitant partager un parcours sécurisé et économique.</p>
                <p>Nombre de places disponibles : <strong>{{ $trajet->nb_places }}</strong>.</p>
                <p>Prix par personne : <strong>{{ $trajet->prix }} DT</strong>.</p>
            </div>
            <div class="col-lg-4">
                <div class="bg-light p-4 rounded">
                    <h3 class="h5 mb-3">Détails du trajet</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3"><strong>Date :</strong> {{ optional($trajet->date)->format('d/m/Y') }}</li>
                        <li class="mb-3"><strong>Heure :</strong> {{ $trajet->heure }}</li>
                        <li class="mb-3"><strong>Places offertes :</strong> {{ $trajet->nb_places }}</li>
                        <li class="mb-3"><strong>Prix :</strong> {{ $trajet->prix }} DT</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="bg-white rounded shadow-sm p-5">
                    <h2 class="h4 mb-3">Description</h2>
                    <p>Ce trajet proposé par {{ $trajet->conducteur->name ?? 'un conducteur' }} permet de partager les frais et voyager confortablement.</p>
                    <p>Profitez d’un trajet où la sécurité, la ponctualité et la convivialité sont prioritaires.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary mt-3">Contacter l'équipe</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
