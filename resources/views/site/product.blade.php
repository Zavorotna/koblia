<x-site-layout>
    <x-slot name="main">
        @php
            $attrs = $product->attributeValues->mapWithKeys(function($attr) {
                return [$attr->attribute->name => $attr->value];
            });
        @endphp
        <div class="wrapper wrapper_card">
            <div class="product_card grid col_2_card gap_50">
                <div class="wine-image">
                    <img src="{{ $product->getMedia('main')->isNotEmpty() ? $product->getFirstMediaUrl('main') : asset('/img/no-img.png') }}" alt="{{ $product->getFirstMedia('main') ? $product->getFirstMedia('main')->getCustomProperty('alt') : $product->title }}">
                </div>
                <div class="description_product">
                    <h1 class="wine-title">{{ $product->title }}</h1>
                    @if($product->attributes)
                    <p class="type_vine">
                        <span>{{ $attrs['Вид'] ?? '' }}</span>
                        <span>({{ $attrs['Тип'] ?? '' }})</span>
                    </p>
                    @endif
                    <div class="wine_attributes">
                        {{-- @dd($attributes) --}}
                            <div class="flex items_center gap_40">
                                @foreach($attributes as $attributeName => $values)
                                    @if($attributeName == 'Вміст алкоголю')
                                        <p><span class="span_text">{{ $attributeName }}: </span>{{ $values->pluck('value')->join(', ') }}</p>
                                    @endif
                                    @if($attributeName == 'Цукор')
                                        <p><span class="span_text">{{ $attributeName }}: </span>{{ $values->pluck('value')->join(', ') }}</p>
                                    @endif
                                @endforeach
                            </div>
                            @foreach($attributes as $attributeName => $values)
                                @if($attributeName == 'Сорти винограду')
                                    <p><span class="span_text">{{ $attributeName }}: </span>{{ $values->pluck('value')->join(', ') }}</p>
                                @endif
                            @endforeach
                    </div>
                    <div class="haracteristic_vine">
                        @foreach($attributes as $attributeName => $values)
                            @if($attributeName == 'Смак')
                                <p><b>{{ $attributeName }}: </b>{{ $values->pluck('value')->join(', ') }}</p>
                            @endif
                            @if($attributeName == 'Аромат')
                                <p><b>{{ $attributeName }}: </b>{{ $values->pluck('value')->join(', ') }}</p>
                            @endif
                            @if($attributeName == 'Походження')
                                <p><b>{{ $attributeName }}: </b>{{ $values->pluck('value')->join(', ') }}</p>
                            @endif
                            @if($attributeName == 'Гастропара')
                                <p><b>{{ $attributeName }}: </b>{{ $values->pluck('value')->join(', ') }}</p>
                            @endif
                        @endforeach
                        <a href="#" class="cta fill_btn">замовити</a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-site-layout>
    