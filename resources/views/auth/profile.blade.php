@extends('layouts.app')

@section('title', 'Mon Profil • CovoitPro')

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
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Mon Profil</h1>
        <p class="text-gray-600 mb-8">Gérez les informations de votre compte</p>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl flex gap-x-3">
                <i class="fa-solid fa-check-circle text-green-600 mt-1"></i>
                <div class="flex-1">
                    <p class="font-semibold text-green-900">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200 p-8 mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Informations Personnelles</h2>
            <form action="{ route('profile.update') }" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('name') border-red-500 @enderror" required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                        <input type="text" disabled value="{{ ucfirst(auth()->user()->role) }}" class="w-full px-5 py-3 border border-gray-200 rounded-2xl bg-gray-50 text-gray-600 cursor-not-allowed">
                        <p class="mt-2 text-xs text-gray-600">Le rôle ne peut pas être changé</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('email') border-red-500 @enderror" required>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone', auth()->user()->telephone) }}" placeholder="+216 XX XXX XXX" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('telephone') border-red-500 @enderror">
                    @error('telephone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="my-6">

                <h3 class="text-lg font-bold text-gray-900">Changer le mot de passe</h3>
                <p class="text-sm text-gray-600 mb-4">Laissez vides si vous ne souhaitez pas changer votre mot de passe</p>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" class="w-full px-5 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>

                <div class="flex gap-x-3 pt-6">
                    <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-2xl transition-colors">
                        <i class="fa-solid fa-save"></i> Enregistrer les modifications
                    </button>
                    <a href="{ route('home') }" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-2xl transition-colors text-center">
                        Annuler
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-red-50 border border-red-200 rounded-2xl p-8">
            <h3 class="text-lg font-bold text-red-900 mb-2">Supprimer mon compte</h3>
            <p class="text-sm text-red-800 mb-4">
                Cette action est irréversible. Toutes vos données, réservations et trajets seront supprimés.
            </p>
            <form action="{ route('profile.destroy') }" method="POST" onsubmit="return confirm('Êtes-vous absolument sûr ? Cette action ne peut pas être annulée.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg transition-colors">
                    <i class="fa-solid fa-trash"></i> Supprimer mon compte
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
