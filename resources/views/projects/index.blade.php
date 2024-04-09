<x-layout>

    <div class="container mx-auto px-4 py-8">
        <div class="col-span-3 mb-10">
            {{ $projects->links() }}
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <a href="/projects/{{ $project->id }}" class="block transform transition duration-500 hover:scale-105">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg" x-data="{ hover: false }"
                        @mouseenter="hover = true" @mouseleave="hover = false">
                        <img class="w-full" src="{{ asset('storage/' . $project->thumbnail_image) }}"
                            alt="{{ $project->name }}" style="height: 200px; object-fit: cover;">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $project->name }}</div>
                            <p class="text-gray-700 text-base">
                                {{ Str::limit($project->description, 100) }}
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2" x-show="hover">
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Learn
                                More</span>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>

</x-layout>
