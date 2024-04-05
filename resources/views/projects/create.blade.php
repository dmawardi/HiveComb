<x-layout>
    <x-slot name="title">Create a New Project</x-slot>

    <h1>Create a New Project</hh1>

        <form method="POST" action="/projects">
            @csrf

            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description" required>{{ old('description') }}</textarea>
            </div>

            <div>
                <button type="submit">Create Project</button>
            </div>
        </form>

        {{-- @include('errors') --}}
</x-layout>
