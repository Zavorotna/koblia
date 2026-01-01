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
                <input type="checkbox" 
                    name="is_top" 
                    class="form-check-input" 
                    value="1"
                    {{ old('is_top', $product->is_top ?? false) ? 'checked' : '' }}>
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
                <label class="form-label">Main Image</label>
                <input type="file" name="main_image" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Gallery</label>
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
                            <option value="{{ $value->id }}" {{ old('attributes.'.$attribute->id) == $value->id ? 'selected' : '' }}>
                                {{ $value->value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach

            <button class="btn btn-success">Create</button>
        </form>
    </x-slot>
</x-app-layout>
