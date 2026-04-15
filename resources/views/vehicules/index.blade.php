@extends('layouts.app')

@section('title', 'Mes Véhicules • CovoitPro')

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
                <h1 class="text-4xl font-bold text-gray-900">Mes Véhicules</h1>
                <p class="text-gray-600 mt-2">Gérez votre flotte de véhicules</p>
            </div>
            <a href="{ route('vehicules.create') }" class="inline-flex items-center justify-center gap-x-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-2xl">
                <i class="fa-solid fa-plus"></i> Ajouter un véhicule
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($vehicules as $vehicule)
                <div class="bg-white rounded-2xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                    <div class="flex justify-between items-start mb-4 gap-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $vehicule->marque }} {{ $vehicule->modele }}</h3>
                            <p class="text-sm text-gray-600">{{ $vehicule->annee }} • <span class="inline-block w-6 h-6 rounded-full border-2" style="border-color: {{ $vehicule->couleur }};"></span> {{ $vehicule->couleur }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-600">Immatriculation</p>
                            <p class="text-lg font-bold text-gray-900">{{ $vehicule->immatriculation }}</p>
                        </div>
                    </div>

                    <div class="bg-emerald-50 rounded-lg p-4 mb-6">
                        <div class="flex items-center gap-x-3">
                            <i class="fa-solid fa-users text-emerald-600 text-2xl"></i>
                            <div>
                                <p class="text-sm text-gray-600">Capacité</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $vehicule->places }} <span class="text-lg">places</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{ route('vehicules.edit', $vehicule) }" class="flex-1 px-4 py-2 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 font-medium text-center">
                            <i class="fa-solid fa-edit"></i> Modifier
                        </a>
                        <form action="{ route('vehicules.destroy', $vehicule) }" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Êtes-vous sûr ?')" class="w-full px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 font-medium">
                                <i class="fa-solid fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-2 bg-white rounded-2xl border border-gray-200 p-12 text-center">
                    <i class="fa-solid fa-car text-6xl text-gray-300 mb-4 block"></i>
                    <p class="text-gray-600 text-lg mb-4">Vous n'avez pas encore de véhicules</p>
                    <a href="{ route('vehicules.create') }" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-2xl">
                        <i class="fa-solid fa-plus"></i> Ajouter mon premier véhicule
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
