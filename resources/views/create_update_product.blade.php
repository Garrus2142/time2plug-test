@extends('layouts.app')

@section('content')
  <div class="card mx-auto" style="width: 30em;">
    {{-- <img src="https://www.puratos.ch/content/dam/puratos/images/products/no_image_available-product.png" --}}
    {{-- class="card-image-top" alt="..." /> --}}
    <div class="card-body">
      <h5 class="card-title">
        @isset($product)
          Modifier
        @else
          Ajouter
        @endisset un produit
      </h5>

      <form action={{ isset($product) ? route('product.update', ['id' => $product->id]) : route('product.create') }}
        method="POST">
        @csrf
        @isset($product)
          @method('PATCH')
        @endisset

        <div class="mb-3">
          <label for="title" class="form-label">Titre:</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
            value="@isset($product) {{ $product->title }}@endisset" required />
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description:</label>
          <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
            rows="4" required>
@isset($product)
{{ $product->description }}
@endisset
</textarea>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <button type="submit" class="btn btn-primary align-items-end">Sauvegarder</button>
      </form>
    </div>
  </div>
@endsection()
