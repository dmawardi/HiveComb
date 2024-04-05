<x-layout>
    <x-slot name="title">Contact Us</x-slot>

    <h1>Contact Us</hh1>

        <form method="POST" action="/inquiries">
            @csrf

            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label for="message">Message</label>
                <textarea name="message" id="message" required>{{ old('message') }}</textarea>
            </div>

            <div>
                <button type="submit">Submit</button>
            </div>
        </form>

        {{-- @include('errors') --}}
</x-layout>
