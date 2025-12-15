<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <h1>Редагувати атрибут</h1>

            <form action="{{ route('attribute.update', $attribute) }}" method="POST">
                @method('patch')
                @include('admin.attributes._form', ['attribute' => $attribute])
            </form>
        </div>
    </x-slot>
</x-app-layout>