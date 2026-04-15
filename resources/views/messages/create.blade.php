@extends('layouts.app')

@section('title', 'Nouveau Message')

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-title mb-5">
                    <h2>Envoyer un Message</h2>
                </div>
                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="recipient">Destinataire</label>
                        <select class="form-control @error('recipient_id') is-invalid @enderror" id="recipient" name="recipient_id" required>
                            <option value="">Sélectionner un destinataire</option>
                            {{-- Placeholder: In real app, populate with users --}}
                        </select>
                        @error('recipient_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Sujet</label>
                        <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required>
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Message</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <a href="{{ route('messages.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection