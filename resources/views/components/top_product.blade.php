<section class="top_product b_bottom">
    <div class="wrapper">
        <h2>топ продажів</h2>
        <div class="grid col_4 gap_20">
            @foreach($topProducts as $top)
                @php
                    $attrs = $top->attributeValues->mapWithKeys(function($attr) {
                        return [$attr->attribute->name => $attr->value];
                    });
                @endphp
                <figure class="card">
                    <figcaption class="pos_r">
                        <a class="mask" href="{{ route('site.product', $top->id) }}"></a>
                        <div class="card_block tac">
                            <picture>
                                <img src="{{ $top->getMedia('main')->isNotEmpty() ? $top->getFirstMediaUrl('main') : asset('/img/no-img.png') }}" alt="">
                            </picture>
                            <h3>{{ $top->title }}</h3>
                            @if($top->attributes)
                                <p class="type_vine">
                                    <span>{{ $attrs['Вид'] ?? '' }}</span>
                                    <span>({{ $attrs['Тип'] ?? '' }})</span>
                                </p>
                            @endif
                            @if($top->price)
                                <p class="price">{{$top->price}}₴</p>
                            @endif
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
        <p class="flex justify_center">
            <a class="cta fill_btn" href="{{ route('site.catalogue') }}">каталог</a>
        </p>
    </div>
</section>