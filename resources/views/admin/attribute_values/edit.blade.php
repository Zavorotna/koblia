<x-app-layout>
    <x-slot name="slot">  
        <div class="container">
            <h1>Edit Attribute Value</h1>

            <form action="{{ route('attribute_values.update', $attributeValue) }}" method="POST">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="attribute_id" class="form-label">Attribute</label>
                    <select name="attribute_id" id="attribute_id" class="form-control" required>
                        @foreach($attributes as $attribute)
                            <option value="{{ $attribute->id }}" 
                                {{ (old('attribute_id') ?? $attributeValue->attribute_id) == $attribute->id ? 'selected' : '' }}>
                                {{ $attribute->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('attribute_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="value" class="form-label">Value</label>
                    <input type="text" name="value" id="value" class="form-control" 
                        value="{{ old('value') ?? $attributeValue->value }}" required>
                    @error('value')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('attribute_values.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>

    </x-slot>
</x-app-layout>