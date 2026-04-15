@extends('layouts.app')

@section('title', 'Mes Trajets • CovoitPro')

@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600&display=swap');
        :root { --primary: #00b894; }
        .hero-bg { background: linear-gradient(92deg, #00b894 0%, #00a085 100%); }
    </style>
@endpush


@section('content')
<div class="min-h-[calc(100vh-68px)] bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">Mes Trajets</h1>
                <p class="text-gray-600 mt-2">Gérez et suivez vos trajets en tant que conducteur</p>
            </div>
            <a href="{ route('trajets.create') }" class="inline-flex items-center justify-center gap-x-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-2xl">
                <i class="fa-solid fa-plus"></i> Nouveau trajet
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl flex gap-x-3">
                <i class="fa-solid fa-check-circle text-green-600 mt-1"></i>
                <div class="flex-1">
                    <p class="font-semibold text-green-900">{ session('success') }</p>
                </div>
            </div>
        @endif

        @forelse($trajets as $trajet)
            <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-4 hover:shadow-lg transition-shadow">
                <div class="flex flex-col lg:flex-row justify-between items-start gap-4 mb-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-1">
                            {{ $trajet->depart }} <i class="fa-solid fa-arrow-right text-emerald-600 mx-2"></i> {{ $trajet->destination }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            <i class="fa-solid fa-calendar"></i> {{ $trajet->date->format('d M Y') }} à {{ $trajet->heure }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-emerald-600">{{ $trajet->prix }} DT</p>
                        <p class="text-sm text-gray-600">par personne</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6 py-4 border-y">
                    <div>
                        <p class="text-xs text-gray-600 font-medium">PLACES</p>
                        <p class="text-lg font-bold text-gray-900">{{ $trajet->nb_places }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-medium">RÉSERVATIONS</p>
                        <p class="text-lg font-bold text-gray-900">{{ $trajet->reservations->count() }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-medium">STATUT</p>
                        <p class="text-lg font-bold text-emerald-600">{{ $trajet->reservations->count() * $trajet->prix }} DT</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-medium">REVENUS</p>
                        <p class="text-lg font-bold text-emerald-600">{{ $trajet->reservations->count() * $trajet->prix }} DT</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{ route('trajets.show', $trajet) }" class="flex-1 px-4 py-2 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 font-medium text-center">
                        <i class="fa-solid fa-eye"></i> Voir détails
                    </a>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                        <i class="fa-solid fa-edit"></i> Modifier
                    </button>
                    <button class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 font-medium">
                        <i class="fa-solid fa-trash"></i> Supprimer
                    </button>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
                <i class="fa-solid fa-road text-6xl text-gray-300 mb-4 block"></i>
                <p class="text-gray-600 text-lg mb-4">Vous n'avez pas encore créé de trajets</p>
                <a href="{ route('trajets.create') }" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-2xl">
                    <i class="fa-solid fa-plus"></i> Créer mon premier trajet
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
