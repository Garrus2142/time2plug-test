@extends('layouts.app')

@section('navbar-content')
  <form class="d-flex" role="search">
    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
@endsection()

@section('content')
  <div class="d-flex flex-row flex-wrap gap-3">
    @foreach ($products as $product)
      <div class="card" style="width: 18em;">
        <x-product-photo :product="$product" />
        <div class="card-body">
          <h5 class="card-title">{{ $product->title }}</h5>
          <p class="card-text">{{ Str::limit($product->description, 30) }}</p>
          <a href={{ route('product.show', ['id' => $product->id]) }} class="btn btn-primary">Afficher</a>
        </div>
      </div>
    @endforeach
  </div>
@endsection()
