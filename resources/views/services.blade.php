@extends('layouts.app')

@section('title', 'Services • CovoitPro')

@section('content')
<div class="site-section bg-light py-5">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-7">
                <h2 class="section-title mb-3">Nos Services</h2>
                <p>Découvrez comment CovoitPro aide les conducteurs et passagers à partager leurs trajets en toute simplicité.</p>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-3 mb-4">
                <div class="bg-white rounded shadow-sm p-4 text-center h-100">
                    <span class="d-block display-4 text-primary">{{ $stats['trajets'] }}</span>
                    <p class="mb-0">Trajets validés</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="bg-white rounded shadow-sm p-4 text-center h-100">
                    <span class="d-block display-4 text-primary">{{ $stats['conducteurs'] }}</span>
                    <p class="mb-0">Conducteurs enregistrés</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="bg-white rounded shadow-sm p-4 text-center h-100">
                    <span class="d-block display-4 text-primary">{{ $stats['passagers'] }}</span>
                    <p class="mb-0">Passagers actifs</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="bg-white rounded shadow-sm p-4 text-center h-100">
                    <span class="d-block display-4 text-primary">{{ $stats['reservations'] }}</span>
                    <p class="mb-0">Réservations effectuées</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="bg-white rounded shadow-sm p-5 h-100">
                    <h3 class="h5">Recherche intelligente</h3>
                    <p>Trouvez rapidement un trajet adapté à votre destination et à votre date.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="bg-white rounded shadow-sm p-5 h-100">
                    <h3 class="h5">Gestion simple</h3>
                    <p>Ajoutez des trajets, gérez vos véhicules et suivez vos réservations depuis votre espace.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="bg-white rounded shadow-sm p-5 h-100">
                    <h3 class="h5">Support sécurisé</h3>
                    <p>Profitez d’un service sécurisé et réactif grâce à une interface conviviale.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
