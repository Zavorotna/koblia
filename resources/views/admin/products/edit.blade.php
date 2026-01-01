<x-app-layout>
    <x-slot name="slot">
        <h1>Edit Product</h1>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    {{-- @dump($categories) --}}
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ ($product->category_id ?? old('category_id')) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" 
                    name="is_top" 
                    class="form-check-input" 
                    value="1"
                    {{ old('is_top', $product->is_top ?? false) ? 'checked' : '' }}>
                <label class="form-check-label">Топ товар</label>
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}">
            </div>

            <div class="mb-3">
                <label>Sale Price</label>
                <input type="number" name="saleprice" class="form-control" step="0.01" value="{{ old('saleprice', $product->saleprice) }}">
            </div>

            <div class="mb-3">
                <label>Discount</label>
                <input type="number" name="discount" class="form-control" value="{{ old('discount', $product->discount) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Main Image</label>

                @if($product->getFirstMediaUrl('main'))
                    <div class="mb-2">
                        <img src="{{ $product->getFirstMediaUrl('main') }}" 
                            alt="Main Image" 
                            style="max-width:150px">
                    </div>
                @endif

                <input type="file" name="main_image" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Gallery</label>

                @if($product->hasMedia('gallery'))
                    <div class="d-flex gap-2 mb-2 flex-wrap">
                        @foreach($product->getMedia('gallery') as $image)
                            <img src="{{ $image->getUrl() }}" width="80">
                        @endforeach
                    </div>
                @endif

                <input 
                    type="file" 
                    name="gallery[]" 
                    class="form-control" 
                    multiple
                    accept="image/*"
                >
            </div>

            <h4>Attributes</h4>
            @foreach($attributes as $attribute)
                <div class="mb-2">
                    <label>{{ $attribute->name }}</label>
                    <select name="attributes[{{ $attribute->id }}]" class="form-control">
                        <option value="">-- Select value --</option>
                        @foreach($attribute->values as $value)
                            @php
                                $selected = old('attributes.'.$attribute->id) 
                                    ?? $product->attributes->firstWhere('pivot.attribute_id', $attribute->id)->id ?? '';
                            @endphp
                            <option value="{{ $value->id }}" {{ $selected == $value->id ? 'selected' : '' }}>
                                {{ $value->value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach

            <button class="btn btn-success">Update</button>
        </form>
    </x-slot>
</x-app-layout>
