<x-app-layout>
    <x-slot name="slot">
        <h1>Create Product</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_top" class="form-check-input" value="1" {{ old('is_top') ? 'checked' : '' }}>
                <label class="form-check-label">Топ товар</label>
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price') }}">
            </div>

            <div class="mb-3">
                <label>Sale Price</label>
                <input type="number" name="saleprice" class="form-control" step="0.01" value="{{ old('saleprice') }}">
            </div>

            <div class="mb-3">
                <label>Discount</label>
                <input type="number" name="discount" class="form-control" value="{{ old('discount', 0) }}">
            </div>

            <div class="mb-3">
                <label>Main Image</label>
                <input type="file" name="main_image" class="form-control">
            </div>

            <div class="mb-3">
                <label>Gallery</label>
                <input type="file" name="gallery[]" class="form-control" multiple accept="image/*">
            </div>

            <h4>Attributes</h4>
            @foreach($attributes as $attribute)
                @php
                    $selectedValues = old('attributes.'.$attribute->id, []);
                @endphp
                <div class="mb-3">
                    <label>{{ $attribute->name }}</label>

                    @if($attribute->type === 'text')
                        <input type="text" name="attributes[{{ $attribute->id }}]" class="form-control"
                            value="{{ $selectedValues[0] ?? '' }}">
                    @elseif($attribute->type === 'select')
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

            <button class="btn btn-success">Create</button>
        </form>
    </x-slot>
</x-app-layout>
