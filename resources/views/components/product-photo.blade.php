<img
  src={{ asset(
      isset($product) && $product->photo_filename
          ? 'storage/products_photos/' . $product->photo_filename
          : 'images/no_image_available-product.png',
  ) }}
  class="card-image-top" alt="..." style="height: 20vh; object-fit: cover;" />
