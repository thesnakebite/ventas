@props([
    'cardTitle' => '',
    'cardTools' => '',
    'cardFooter' => '',
])

<div class="card" style="width: 18rem;">
    <div class="card-header">
        <h5 class="card-title">{{ $cardTitle }}</h5>
        <div class="card-tools">
            {{ $cardTools }}
        </div>
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
    <div class="card-footer">
        {{ $cardFooter }}
    </div>
</div>