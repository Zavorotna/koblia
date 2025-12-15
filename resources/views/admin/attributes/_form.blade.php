@csrf
<div class="mb-3">
    <label class="form-label">Назва</label>
    <input type="text"
           name="name"
           value="{{ old('name', $attribute->name ?? '') }}"
           class="form-control">
    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Тип</label>
    <select name="type" class="form-select">
        @foreach(['text', 'select', 'multiselect'] as $type)
            <option value="{{ $type }}"
                @selected(old('type', $attribute->type ?? '') === $type)>
                {{ ucfirst($type) }}
            </option>
        @endforeach
    </select>
    @error('type') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="form-check mb-3">
    <input type="checkbox"
           name="is_filterable"
           value="1"
           class="form-check-input"
           @checked(old('is_filterable', $attribute->is_filterable ?? false))>

    <label class="form-check-label">Використовувати у фільтрах</label>
</div>

<button class="btn btn-success">Зберегти</button>
<a href="{{ route('attribute.index') }}" class="btn btn-secondary">Назад</a>
