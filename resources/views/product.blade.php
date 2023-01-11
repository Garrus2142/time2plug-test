@extends('layouts.app')

@section('content')
  <div class="card mx-auto" style="width: 30em;">
    <x-product-photo :product="$product" />
    <div class="card-body">
      <h5 class="card-title">{{ $product->title }}</h5>
      <p class="card-text">{{ $product->description }}</p>
      <div class="d-flex justify-content-end gap-2">
        <form action={{ route('product.delete', ['id' => $product->id]) }} method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger align-items-end">Supprimer</button>
        </form>
        <a href={{ route('product.show_update', ['id' => $product->id]) }}
          class="btn btn-primary align-items-end">Modifier</a>
      </div>
    </div>
  </div>
@endsection()
