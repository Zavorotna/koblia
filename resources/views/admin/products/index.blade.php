<x-app-layout>
    <x-slot name="slot">
        <h1>Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Add Product</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Sale Price</th>
                    <th>Discount</th>
                    <th>Attributes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->getMainImageUrl())
                            <img src="{{ $product->getMainImageUrl() }}" width="50" alt="Image">
                        @endif
                    </td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->saleprice }}</td>
                    <td>{{ $product->discount }}%</td>
                    <td>
                        @foreach($product->attributes as $attr)
                            {{ $attr->attribute->name }}: {{ $attr->value }}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->links() }}
    </x-slot>
</x-app-layout>