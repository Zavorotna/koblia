<x-app-layout>
    <x-slot name="slot">       
        <div class="container">
            <h1>Attribute Values</h1>

            <a href="{{ route('attribute_values.create') }}" class="btn btn-primary mb-3">Add New Value</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Attribute</th>
                        <th>Value</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($values as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->attribute->name }}</td>
                            <td>{{ $value->value }}</td>
                            <td>
                                <a href="{{ route('attribute_values.edit', $value) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('attribute_values.destroy', $value) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No attribute values found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $values->withQueryString()->onEachSide(2)->links('vendor.pagination.custom') }}
        </div>
    </x-slot>
</x-app-layout>