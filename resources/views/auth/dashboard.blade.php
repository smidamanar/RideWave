@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="site-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="bg-white p-4 mb-4">
          <h2 class="mb-3">Welcome, {{ auth()->user()->name }}</h2>
          <p>You are logged in as <strong>{{ ucfirst(auth()->user()->role) }}</strong>.</p>

          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif

          <div class="row">
            @if(auth()->user()->role === 'conducteur')
              <div class="col-md-4 mb-3">
                <a href="{{ route('trajets.create') }}" class="btn btn-primary btn-block">Create a new trip</a>
              </div>
              <div class="col-md-4 mb-3">
                <a href="{{ route('trajets.my') }}" class="btn btn-secondary btn-block">My Trips</a>
              </div>
            @endif
            @if(auth()->user()->role === 'passager')
              <div class="col-md-4 mb-3">
                <a href="{{ route('cars') }}" class="btn btn-primary btn-block">Search trips to reserve</a>
              </div>
              <div class="col-md-4 mb-3">
                <a href="{{ route('reservations.my') }}" class="btn btn-secondary btn-block">My Reservations</a>
              </div>
            @endif
            @if(auth()->user()->role === 'admin')
              <div class="col-md-4 mb-3">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-block">Admin Panel</a>
              </div>
            @endif
            <div class="col-md-4 mb-3">
              <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-block">Mon profil</a>
            </div>
          </div>

          <div class="mt-4">
            <h4>Account details</h4>
            <ul class="list-unstyled">
              <li><strong>Name:</strong> {{ auth()->user()->name }}</li>
              <li><strong>Email:</strong> {{ auth()->user()->email }}</li>
              <li><strong>Role:</strong> {{ auth()->user()->role }}</li>
              <li><strong>Telephone:</strong> {{ auth()->user()->telephone ?? 'Not provided' }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
