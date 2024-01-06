@props(['item'=>null])

<img src="{{ $item->image ? Storage::url('public/' . $item->image->url) : asset('no-image.png')  }}"
     class="img-fluid rounded"
     width="60"
     alt="{{ $item->name }}"
/>