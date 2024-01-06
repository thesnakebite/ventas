@props(['item'=>null, 'size'=>70, 'float'=>'' ])

<img src="{{ $item->image ? Storage::url('public/' . $item->image->url) : asset('no-image.png')  }}"
     class="img-fluid rounded {{ $float }}"
     width="{{ $size }}"
     alt="{{ $item->name }}"
/>