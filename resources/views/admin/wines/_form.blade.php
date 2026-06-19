@php $wine = $wine ?? null; @endphp

<div class="row">
    <div class="col-md-8 mb-3">
        <label for="name" class="form-label">Naziv vina *</label>
        <input type="text" name="name" id="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $wine->name ?? '') }}" required maxlength="255">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="year" class="form-label">Godina</label>
        <input type="number" name="year" id="year"
               class="form-control @error('year') is-invalid @enderror"
               value="{{ old('year', $wine->year ?? '') }}" min="1900" max="{{ date('Y') }}">
        @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="price" class="form-label">Cena (RSD) *</label>
        <input type="number" step="0.01" name="price" id="price"
               class="form-control @error('price') is-invalid @enderror"
               value="{{ old('price', $wine->price ?? '') }}" required min="0">
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="stock" class="form-label">Zalihe *</label>
        <input type="number" name="stock" id="stock"
               class="form-control @error('stock') is-invalid @enderror"
               value="{{ old('stock', $wine->stock ?? 0) }}" required min="0">
        @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="category_id" class="form-label">Kategorija *</label>
        <select name="category_id" id="category_id"
                class="form-select @error('category_id') is-invalid @enderror" required>
            <option value="">— izaberi —</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $wine->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="winery_id" class="form-label">Vinarija *</label>
        <select name="winery_id" id="winery_id"
                class="form-select @error('winery_id') is-invalid @enderror" required>
            <option value="">— izaberi —</option>
            @foreach($wineries as $winery)
                <option value="{{ $winery->id }}"
                    {{ old('winery_id', $wine->winery_id ?? '') == $winery->id ? 'selected' : '' }}>
                    {{ $winery->name }}
                </option>
            @endforeach
        </select>
        @error('winery_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Opis</label>
    <textarea name="description" id="description" rows="6"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $wine->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">Slika vina</label>
    <input type="file" name="image" id="image"
           class="form-control @error('image') is-invalid @enderror" accept="image/*">
    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

    @if($wine && $wine->image)
        @php
            $src = \Illuminate\Support\Str::startsWith($wine->image, 'http')
                ? $wine->image : asset('storage/' . $wine->image);
        @endphp
        <div class="mt-2">
            <small class="text-muted d-block mb-1">Trenutna slika:</small>
            <img src="{{ $src }}" alt="" style="height:80px;border-radius:.4rem;">
            <div class="form-check mt-2">
                <input type="checkbox" name="remove_image" value="1" id="remove_image" class="form-check-input">
                <label for="remove_image" class="form-check-label text-danger">Ukloni sliku</label>
            </div>
        </div>
    @endif
</div>

<div class="form-check mb-3">
    <input type="checkbox" name="featured" value="1" id="featured" class="form-check-input"
           {{ old('featured', $wine->featured ?? false) ? 'checked' : '' }}>
    <label for="featured" class="form-check-label">
        <strong>Istaknuto</strong> — prikaži na početnoj strani
    </label>
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