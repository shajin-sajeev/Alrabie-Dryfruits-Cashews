@props(['items'])

<nav class="breadcrumb" aria-label="Breadcrumb">
    <div class="breadcrumb-container">
        <a href="{{ route('home') }}" class="breadcrumb-item">
            <span>🏠 Home</span>
        </a>
        @foreach ($items as $item)
            <span class="breadcrumb-separator">/</span>
            @if (isset($item['url']))
                <a href="{{ $item['url'] }}" class="breadcrumb-item">{{ $item['label'] }}</a>
            @else
                <span class="breadcrumb-item active">{{ $item['label'] }}</span>
            @endif
        @endforeach
    </div>
</nav>
