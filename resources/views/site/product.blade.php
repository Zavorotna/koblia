<x-site-layout>
    <x-slot name="main">
        <div class="wine-details">
    <div class="wine-image">
        @if($product->getMedia('main')->first())
            <img src="{{ $product->getMedia('main')->first()->getUrl() }}" 
                 alt="{{ $product->getFirstMedia('main') ? $product->getFirstMedia('main')->getCustomProperty('alt') : $product->title }}">
        @endif
    </div>

    <div class="wine-info">
        <h1 class="wine-title">{{ $product->title }}</h1>
        
        @if($product->category)
            <p class="wine-category">{{ $product->category->name }}</p>
        @endif
        <div class="wine-attributes">
            @foreach($attributes as $attributeName => $values)
                <div class="attribute-row">
                    <strong>{{ $attributeName }}:</strong>
                    <span>
                        {{ $values->pluck('value')->join(', ') }}
                    </span>
                </div>
            @endforeach
        </div>


        <button class="btn-order">ЗАМОВИТИ</button>
    </div>
</div>
    </x-slot>
</x-site-layout>
    