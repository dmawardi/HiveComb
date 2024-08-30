<x-layout>
    <x-slot name="title">Contact Us</x-slot>
    <x-honeycomb-float>

        <div class="w-10/12 mx-auto relative z-40 bg-gray-600 rounded-md shadow-lg">
            <div class="container mx-auto px-4 py-4 mt-6">
                <h1 class="text-3xl font-bold text-center mb-8 mt-4 text-gray-100">Contact Us</h1>
                <form action="{{ route('inquiries.store') }}" method="POST" class="max-w-3xl mx-auto">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-200 text-sm font-bold mb-2">Name</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-200 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-200 text-sm font-bold mb-2">Phone
                            (Optional)</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline">
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="company_name" class="block text-gray-200 text-sm font-bold mb-2">Company Name
                            (Optional)</label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline">
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="website" class="block text-gray-200 text-sm font-bold mb-2">Website
                            (Optional)</label>
                        <input type="text" name="website" id="website" value="{{ old('website') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline">
                        <x-input-error :messages="$errors->get('website')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="type" class="block text-gray-200 text-sm font-bold mb-2">Inquiry Type</label>
                        <select name="type" id="type" required
                            class="shadow border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="general">General</option>
                            <option value="quote">Quote</option>
                            <option value="support">Support</option>
                            <option value="partnership">Partnership</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="message" class="block text-gray-200 text-sm font-bold mb-2">Message</label>
                        <textarea name="message" id="message" required rows="4"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline">{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <div class="flex flex-row-reverse">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-honeycomb-float>
</x-layout>
