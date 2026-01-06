<x-site-layout>
    <x-slot name="main">
        <div class="wrapper catalogue">
            {{-- @dd($categories) --}}
            <h1 class="tac">каталог</h1>
            <div class="flex justify_center gap_40 btn_catalogue">
                <a class="filter-link cta transparent_btn active" data-category="" href="{{ route('site.catalogue') }}">УСІ ВИНА</a>
                @foreach($categories as $category)
                    <a class="filter-link cta transparent_btn" data-category="{{ $category->id }}" href="{{ route('site.catalogue', ['category' => $category->id]) }}">
                        {{ strtoupper($category->title) }}
                    </a>
                @endforeach
            </div>
            <div class="catalogue_container grid col_4 gap_20">
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
            </div>
        </div>
    </x-slot>
</x-site-layout>
    