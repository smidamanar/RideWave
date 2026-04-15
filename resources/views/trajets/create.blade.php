@extends('layouts.app')

@section('title', 'Créer un Trajet • CovoitPro')

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
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Créer un nouveau trajet</h1>
        <p class="text-gray-600 mb-8">Proposez un trajet et gagnez de l'argent</p>

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
            <form action="{ route('trajets.store') }" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Départ</label>
                        <input type="text" name="depart" value="{{ old('depart') }}" placeholder="ex: Tunis" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('depart') border-red-500 @enderror" required>
                        @error('depart')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Destination</label>
                        <input type="text" name="destination" value="{{ old('destination') }}" placeholder="ex: Sfax" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('destination') border-red-500 @enderror" required>
                        @error('destination')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="date" name="date" value="{{ old('date') }}" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('date') border-red-500 @enderror" required>
                        @error('date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Heure</label>
                        <input type="time" name="heure" value="{{ old('heure') }}" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('heure') border-red-500 @enderror" required>
                        @error('heure')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Prix par personne (DT)</label>
                        <input type="number" step="0.01" name="prix" value="{{ old('prix') }}" placeholder="ex: 15.50" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('prix') border-red-500 @enderror" required>
                        @error('prix')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de places disponibles</label>
                        <input type="number" name="nb_places" value="{{ old('nb_places') }}" placeholder="ex: 3" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('nb_places') border-red-500 @enderror" required>
                        @error('nb_places')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-x-3 pt-6 flex-col sm:flex-row">
                    <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-2xl transition-colors">
                        <i class="fa-solid fa-plus"></i> Créer le trajet
                    </button>
                    <a href="{ route('trajets.my') }" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-2xl transition-colors text-center">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
