@extends('layouts.public')
@section('title', 'Kontakt — E-Vinoteka')

@section('content')

{{-- Naslov --}}
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Kontaktirajte nas</h1>
        <p>Imate pitanje o ponudi, porudžbini ili dostavi? Tu smo za vas.</p>
    </div>
</div>

{{-- Google mapa (embed iframe) --}}
<div class="w-100">
    <iframe
        src="https://www.google.com/maps?q=Knez%20Mihailova%201%2C%20Beograd&output=embed"
        width="100%" height="350" style="border:0;" allowfullscreen=""
        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>

{{-- Kontakt podaci + forma --}}
<div class="container py-5">
    <div class="row py-5">

        {{-- Kontakt podaci --}}
        <div class="col-md-4 mb-4">
            <h2 class="h4 mb-4">Kontakt podaci</h2>
            <ul class="list-unstyled">
                <li class="mb-3">
                    <i class="fas fa-map-marker-alt fa-fw text-success me-2"></i>
                    Knez Mihailova 1, Beograd
                </li>
                <li class="mb-3">
                    <i class="fa fa-phone fa-fw text-success me-2"></i>
                    <a class="text-decoration-none text-dark" href="tel:011-123-4567">011 / 123-4567</a>
                </li>
                <li class="mb-3">
                    <i class="fa fa-envelope fa-fw text-success me-2"></i>
                    <a class="text-decoration-none text-dark" href="mailto:info@evinoteka.rs">info@evinoteka.rs</a>
                </li>
                <li class="mb-3">
                    <i class="fa fa-clock fa-fw text-success me-2"></i>
                    Pon–Sub: 09–21h
                </li>
            </ul>
            <div class="mt-3">
                <a class="text-success me-3" href="#"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a class="text-success me-3" href="#"><i class="fab fa-instagram fa-lg"></i></a>
            </div>
        </div>

        {{-- Forma --}}
        <div class="col-md-8">
            <h2 class="h4 mb-4">Pošaljite nam poruku</h2>
            <form method="post" action="{{ route('contact.send') }}" role="form">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="name">Ime</label>
                        <input type="text" class="form-control mt-1 @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}" placeholder="Vaše ime" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mt-1 @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" placeholder="Vaš email" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="subject">Naslov</label>
                    <input type="text" class="form-control mt-1 @error('subject') is-invalid @enderror"
                           id="subject" name="subject" value="{{ old('subject') }}" placeholder="Naslov poruke" required>
                    @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="message">Poruka</label>
                    <textarea class="form-control mt-1 @error('message') is-invalid @enderror"
                              id="message" name="message" rows="6" placeholder="Vaša poruka" required>{{ old('message') }}</textarea>
                    @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success btn-lg px-4">Pošalji</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection