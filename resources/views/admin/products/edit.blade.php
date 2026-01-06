<x-app-layout>
    <x-slot name="slot">
        <h1>Edit Product</h1>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
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
                <input type="checkbox" name="is_top" class="form-check-input" value="1"
                    {{ old('is_top', $product->is_top) ? 'checked' : '' }}>
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
                <label>Main Image</label>
                @if($product->getFirstMediaUrl('main'))
                    <div class="mb-2">
                        <img src="{{ $product->getFirstMediaUrl('main') }}" alt="Main Image" style="max-width:150px">
                    </div>
                @endif
                <input type="file" name="main_image" class="form-control">
            </div>

            <div class="mb-3">
                <label>Gallery</label>
                @if($product->hasMedia('gallery'))
                    <div class="d-flex gap-2 mb-2 flex-wrap">
                        @foreach($product->getMedia('gallery') as $image)
                            <img src="{{ $image->getUrl() }}" width="80">
                        @endforeach
                    </div>
                @endif
                <input type="file" name="gallery[]" class="form-control" multiple accept="image/*">
            </div>

            <h4>Attributes</h4>
            @foreach($attributes as $attribute)
                @php
                    $selectedValues = old('attributes.'.$attribute->id) 
                        ?? $product->attributeValues->where('pivot.attribute_id', $attribute->id)->pluck('id')->toArray();
                @endphp
                <div class="mb-3">
                    <label>{{ $attribute->name }}</label>

                    @if($attribute->type === 'text' || $attribute->type === 'select')
                        <select name="attributes[{{ $attribute->id }}]" class="form-control">
                            <option value="">-- Select --</option>
                            @foreach($attribute->values as $value)
                                <option value="{{ $value->id }}" {{ in_array($value->id, (array)$selectedValues) ? 'selected' : '' }}>
                                    {{ $value->value }}
                                </option>
                            @endforeach
                        </select>
                    @elseif($attribute->type === 'multiselect')
                        <div class="d-flex flex-wrap gap-2">
                        @foreach($attribute->values as $value)
                            <div class="form-check">
                                    <input 
                                        type="checkbox" 
                                        name="attributes[{{ $attribute->id }}][]" 
                                        value="{{ $value->id }}" 
                                        class="form-check-input"
                                        {{ in_array($value->id, (array)$selectedValues) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label">{{ $value->value }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

            <button class="btn btn-success">Update</button>
        </form>
    </x-slot>
</x-app-layout>
