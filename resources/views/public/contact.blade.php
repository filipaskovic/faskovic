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
{{-- Google mapa (embed iframe) --}}
<div class="w-100">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15936.407717766506!2d37.355627299999995!3d-3.0674246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1839fc5a396ea805%3A0x8e741c478eea6c01!2sMt%20Kilimanjaro!5e0!3m2!1sen!2srs!4v1782033006422!5m2!1sen!2srs"
        width="100%" height="500" style="border:0;" allowfullscreen=""
        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>
@endsection