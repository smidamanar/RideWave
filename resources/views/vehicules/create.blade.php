@extends('layouts.app')

@section('title', 'Ajouter un Véhicule • CovoitPro')

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
    <div class="max-w-2xl mx-auto px-6">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Ajouter un véhicule</h1>
        <p class="text-gray-600 mb-8">Enregistrez votre véhicule pour proposer des trajets</p>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
                <p class="font-semibold text-red-900 mb-3">Veuillez corriger les erreurs :</p>
                <ul class="space-y-2">
                    @foreach($errors->all() as $error)
                        <li class="text-sm text-red-700"><i class="fa-solid fa-xmark"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200 p-8">
            <form action="{ route('vehicules.store') }" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Marque</label>
                        <input type="text" name="marque" value="{{ old('marque') }}" placeholder="ex: Toyota" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('marque') border-red-500 @enderror" required>
                        @error('marque')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Modèle</label>
                        <input type="text" name="modele" value="{{ old('modele') }}" placeholder="ex: Corolla" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('modele') border-red-500 @enderror" required>
                        @error('modele')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Année</label>
                        <input type="number" name="annee" value="{{ old('annee') }}" min="1900" max="{{ date('Y') + 1 }}" placeholder="2022" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('annee') border-red-500 @enderror" required>
                        @error('annee')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Couleur</label>
                        <input type="text" name="couleur" value="{{ old('couleur') }}" placeholder="ex: Blanc" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('couleur') border-red-500 @enderror" required>
                        @error('couleur')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Immatriculation</label>
                        <input type="text" name="immatriculation" value="{{ old('immatriculation') }}" placeholder="ex: 123TN1234" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('immatriculation') border-red-500 @enderror" required>
                        @error('immatriculation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de places</label>
                        <input type="number" name="places" value="{{ old('places') }}" min="1" max="9" placeholder="4" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('places') border-red-500 @enderror" required>
                        @error('places')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-x-3 pt-6 flex-col sm:flex-row">
                    <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-2xl transition-colors">
                        <i class="fa-solid fa-plus"></i> Ajouter le véhicule
                    </button>
                    <a href="{ route('vehicules.index') }" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-2xl transition-colors text-center">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
