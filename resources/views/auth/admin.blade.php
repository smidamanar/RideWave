@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="site-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="bg-white p-4 mb-4">
          <h2 class="mb-3">Admin Dashboard</h2>
          <p>Manage the platform and monitor activity.</p>

          <div class="row mb-4">
            <div class="col-md-3 mb-3">
              <div class="border p-3 text-center">
                <h3>{{ $users }}</h3>
                <p>Users</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="border p-3 text-center">
                <h3>{{ $trajets }}</h3>
                <p>Trips</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="border p-3 text-center">
                <h3>{{ $reservations }}</h3>
                <p>Reservations</p>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="border p-3 text-center">
                <h3>{{ $vehicules }}</h3>
                <p>Vehicles</p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <h4>Administrative actions</h4>
              <p class="mb-0">Use the admin API and backend to manage users, trips, vehicles, and reservations.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
