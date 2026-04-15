@extends('layouts.app')

@section('title', 'Contact - Covoiturage')

@section('content')

<div class="ftco-blocks-cover-1">
  <div class="ftco-cover-1 overlay innerpage" style="background-image: url('{{ asset('images/hero_2.jpg') }}')">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 text-center">
          <h1>Contactez-nous</h1>
          <p>Nous sommes là pour vous aider à organiser votre covoiturage.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="site-section bg-light" id="contact-section">
  <div class="container">

    <div class="row justify-content-center text-center">
      <div class="col-7 text-center mb-5">
        <h2>Contactez un conducteur ou l'équipe d'assistance</h2>
        <p>Envoyez-nous un message pour toute question sur votre covoiturage.</p>
      </div>
    </div>

    {{-- Success message --}}
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Validation errors --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="row">

      {{-- Contact Form --}}
      <div class="col-lg-8 mb-5">
        <form action="{{ route('contact.send') }}" method="POST">
          @csrf

          <div class="form-group row">
            <div class="col-md-6 mb-4 mb-lg-0">
              <input
                type="text"
                name="first_name"
                class="form-control @error('first_name') is-invalid @enderror"
                placeholder="First name"
                value="{{ old('first_name') }}"
              >
              @error('first_name')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-md-6">
              <input
                type="text"
                name="last_name"
                class="form-control @error('last_name') is-invalid @enderror"
                placeholder="Last name"
                value="{{ old('last_name') }}"
              >
              @error('last_name')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-12">
              <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Email address"
                value="{{ old('email') }}"
              >
              @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-12">
              <textarea
                name="message"
                class="form-control @error('message') is-invalid @enderror"
                placeholder="Write your message."
                cols="30"
                rows="10"
              >{{ old('message') }}</textarea>
              @error('message')
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-6 mr-auto">
              <button type="submit" class="btn btn-block btn-primary text-white py-3 px-5">
                Send Message
              </button>
            </div>
          </div>

        </form>
      </div>

      {{-- Contact Info --}}
      <div class="col-lg-4 ml-auto">
        <div class="bg-white p-3 p-md-5">
          <h3 class="text-black mb-4">Contact Info</h3>
          <ul class="list-unstyled footer-link">
            <li class="d-block mb-3">
              <span class="d-block text-black">Address:</span>
              <span>34 Street Name, City Name Here, United States</span>
            </li>
            <li class="d-block mb-3">
              <span class="d-block text-black">Phone:</span>
              <span>+1 242 4942 290</span>
            </li>
            <li class="d-block mb-3">
              <span class="d-block text-black">Email:</span>
              <span>support@covoiturage.com</span>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection