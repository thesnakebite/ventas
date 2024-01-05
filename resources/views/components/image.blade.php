@props(['item'=>null])

<img src="{{ $item->image ? Storage::url('public/' . $item->image->url) : ''  }}"
     class="img-fluid rounded"
     width="100"
     alt="{{ $item->name }}"
/>