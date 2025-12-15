<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <h1>Атрибути</h1>

            <a href="{{ route('attribute.create') }}" class="btn btn-primary mb-3">
                + Додати атрибут
            </a>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Назва</th>
                    <th>Тип</th>
                    <th>Дії</th>
                </tr>
                </thead>

                <tbody>
                @foreach($attributes as $attribute)
                    <tr>
                        <td>{{ $attribute->id }}</td>
                        <td>{{ $attribute->name }}</td>
                        <td>{{ $attribute->type }}</td>
                        <td>
                            <a href="{{ route('attribute.edit', $attribute) }}"
                            class="btn btn-sm btn-warning">
                                ✏️
                            </a>

                            <form action="{{ route('attribute.destroy', $attribute) }}"
                                method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">🗑</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $attributes->links() }}
    </x-slot>
</x-app-layout>
