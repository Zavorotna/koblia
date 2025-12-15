<x-app-layout>
    <x-slot name="slot">
        <div class="container">
            <h1>Створити атрибут</h1>

            <form action="{{ route('attribute.store') }}" method="POST">
                @include('admin.attributes._form')
            </form>
        </div>
    </x-slot>
</x-app-layout>