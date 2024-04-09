<x-layout>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <img src="{{ asset('storage/' . $project->thumbnail_image) }}" alt="{{ $project->name }}"
                    class="w-full h-auto rounded-lg shadow-md">
            </div>

            <h1 class="text-3xl font-bold mb-2">{{ $project->name }}</h1>

            @if ($project->status === 'active')
                <span
                    class="inline-block bg-green-200 text-green-800 rounded-full px-3 py-1 text-sm font-semibold mb-4">Active</span>
            @else
                <span
                    class="inline-block bg-gray-200 text-gray-800 rounded-full px-3 py-1 text-sm font-semibold mb-4">Inactive</span>
            @endif

            <p class="text-gray-700 mb-4">
                <strong>Client:</strong> {{ $project->client_name ?? 'N/A' }}
            </p>

            <p class="text-gray-700 mb-4">
                <strong>Completion Date:</strong>
                {{ $project->completion_date ? \Carbon\Carbon::parse($project->completion_date)->format('F d, Y') : 'N/A' }}
            </p>

            <p class="text-gray-700 mb-4">
                <strong>Project URL:</strong> <a href="{{ $project->url }}" class="text-blue-500 hover:underline"
                    target="_blank">{{ $project->url }}</a>
            </p>

            <p class="text-gray-700 mb-4">
                <strong>Technologies Used:</strong> {{ $project->technologies }}
            </p>

            <div class="prose max-w-none mb-8">
                {!! nl2br(e($project->description)) !!}
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @php
                    $galleryImages = json_decode($project->gallery_images);
                @endphp

                @if ($galleryImages)
                    @foreach ($galleryImages as $image)
                        <div class="shadow-lg rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image"
                                class="w-full h-64 object-cover">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

</x-layout>
