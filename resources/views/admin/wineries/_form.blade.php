@php $winery = $winery ?? null; @endphp

<div class="mb-3">
    <label for="name" class="form-label">Naziv vinarije *</label>
    <input type="text" name="name" id="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $winery->name ?? '') }}" required maxlength="255">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="region" class="form-label">Vinski region</label>
        <input type="text" name="region" id="region"
               class="form-control @error('region') is-invalid @enderror"
               value="{{ old('region', $winery->region ?? '') }}" maxlength="255">
        @error('region') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="country" class="form-label">Država</label>
        <input type="text" name="country" id="country"
               class="form-control @error('country') is-invalid @enderror"
               value="{{ old('country', $winery->country ?? '') }}" maxlength="255">
        @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Opis</label>
    <textarea name="description" id="description" rows="6"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $winery->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">Slika vinarije</label>
    <input type="file" name="image" id="image"
           class="form-control @error('image') is-invalid @enderror"
           accept="image/*">
    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

    {{-- prikaz trenutne slike pri izmeni --}}
    @if($winery && $winery->image)
        @php
            $src = \Illuminate\Support\Str::startsWith($winery->image, 'http')
                ? $winery->image
                : asset('storage/' . $winery->image);
        @endphp
        <div class="mt-2">
            <small class="text-muted d-block mb-1">Trenutna slika:</small>
            <img src="{{ $src }}" alt="" style="height:80px;border-radius:.4rem;">
        </div>
    @endif
</div>
<div class="mb-3">
    <label for="logo" class="form-label">Logo vinarije</label>
    <input type="file" name="logo" id="logo"
           class="form-control @error('logo') is-invalid @enderror"
           accept="image/*">
    @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror

    @if($winery && $winery->logo)
        @php
            $logoSrc = \Illuminate\Support\Str::startsWith($winery->logo, 'http')
                ? $winery->logo
                : asset('storage/' . $winery->logo);
        @endphp
        <div class="mt-2">
            <small class="text-muted d-block mb-1">Trenutni logo:</small>
            <img src="{{ $logoSrc }}" alt="" style="height:60px;border-radius:.4rem;">
        </div>
    @endif
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#description',
        height: 300,
        menubar: false,
        plugins: 'lists link',
        toolbar: 'undo redo | bold italic | bullist numlist | link',
        branding: false,
    });
</script>
@endpush