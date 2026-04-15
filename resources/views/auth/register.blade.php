@extends('layouts.app')

@section('title', 'S'inscrire • CovoitPro')

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
<div class="min-h-[calc(100vh-68px)] flex items-center justify-center px-6 py-12 bg-gray-50">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-lg p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">S'inscrire</h2>
                <p class="text-gray-600 mt-2">Créez votre compte CovoitPro gratuitement</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
                    <div class="flex gap-x-3">
                        <i class="fa-solid fa-circle-exclamation text-red-600 mt-1"></i>
                        <div>
                            <p class="font-semibold text-red-900">Erreurs détectées</p>
                            <ul class="mt-2 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="text-sm text-red-700">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{ route('register') }" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('name') border-red-500 @enderror"
                        placeholder="Jean Dupont"
                        required
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('email') border-red-500 @enderror"
                        placeholder="vous@exemple.com"
                        required
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone (optionnel)</label>
                    <input
                        type="text"
                        name="telephone"
                        id="telephone"
                        value="{{ old('telephone') }}"
                        class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('telephone') border-red-500 @enderror"
                        placeholder="+216 XX XXX XXX"
                    >
                    @error('telephone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Vous êtes</label>
                    <select
                        name="role"
                        id="role"
                        class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('role') border-red-500 @enderror"
                        required
                    >
                        <option value="">-- Sélectionnez un rôle --</option>
                        <option value="passager" {{ old('role') === 'passager' ? 'selected' : '' }}>
                            Passager
                        </option>
                        <option value="conducteur" {{ old('role') === 'conducteur' ? 'selected' : '' }}>
                            Conducteur
                        </option>
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('password') border-red-500 @enderror"
                        placeholder="Minimum 6 caractères"
                        required
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-2xl transition-colors"
                >
                    S'inscrire
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-600">Déjà inscrit ?</p>
                <a href="{ route('login') }" class="text-emerald-600 hover:text-emerald-700 font-semibold">
                    Se connecter ici
                </a>
            </div>
        </div>

        <div class="mt-8 bg-emerald-50 border border-emerald-200 rounded-2xl p-6">
            <h3 class="font-semibold text-emerald-900 mb-3">Avantages CovoitPro</h3>
            <ul class="space-y-2 text-sm text-emerald-800">
                <li class="flex gap-x-2"><i class="fa-solid fa-check text-emerald-600"></i> 100% gratuit</li>
                <li class="flex gap-x-2"><i class="fa-solid fa-check text-emerald-600"></i> Trajets vérifiés</li>
                <li class="flex gap-x-2"><i class="fa-solid fa-check text-emerald-600"></i> Paiement sécurisé</li>
                <li class="flex gap-x-2"><i class="fa-solid fa-check text-emerald-600"></i> Support 24/7</li>
            </ul>
        </div>
    </div>
</div>
@endsection
