@props(['items'])

<nav class="breadcrumb" aria-label="Breadcrumb">
    <div class="breadcrumb-container">
        <a href="{{ route('home') }}" class="breadcrumb-item">
            <i class="fas fa-house" style="font-size: 0.9rem;"></i>
            <span>Home</span>
        </a>
        @foreach ($items as $item)
        <i class="fas fa-chevron-right breadcrumb-separator" style="font-size: 0.7rem; opacity: 0.3; margin: 0 0.5rem;"></i>
        @if (isset($item['url']))
        <a href="{{ $item['url'] }}" class="breadcrumb-item">{{ $item['label'] }}</a>
        @else
        <span class="breadcrumb-item active">{{ $item['label'] }}</span>
        @endif
        @endforeach
    </div>
</nav>