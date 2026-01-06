@foreach($products as $p)
    @php
        $attrs = $p->attributeValues->mapWithKeys(function($attr) {
            return [$attr->attribute->name => $attr->value];
        });
    @endphp
    <figure class="card">
        <figcaption class="pos_r">
            <a class="mask" href="{{ route('site.product', $p->id) }}"></a>
            <div class="card_block tac">
                <picture>
                    <img src="{{ $p->getMedia('main')->isNotEmpty() ? $p->getFirstMediaUrl('main') : asset('/img/no-img.png') }}" alt="">
                </picture>
                <h3>{{ $p->title }}</h3>
                @if($p->attributes)
                    <p class="type_vine">
                        <span>{{ $attrs['Вид'] ?? '' }}</span>
                        <span>({{ $attrs['Тип'] ?? '' }})</span>
                    </p>
                @endif
                @if($p->price)
                    <p class="price">{{$p->price}}₴</p>
                @endif
            </div>
        </figcaption>
    </figure>
@endforeach
@if($products->isEmpty())
    <p>Товари не знайдені</p>
@endif