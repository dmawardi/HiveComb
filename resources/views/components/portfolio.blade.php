@props(['projects' => []])
@if (count($projects) > 0)
    <section id="portfolio" class="py-16 bg-white relative z-40">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800">Our Work</h2>
            <p class="text-lg text-center text-gray-600 mt-4 mb-8">Explore some of our projects that have transformed
                businesses.</p>

            <!-- Carousel Container -->
            <div x-data="{ activeSlide: 1, slides: [1, 2, 3] }" class="max-w-4xl mx-auto">
                <!-- Slides -->
                <div class="overflow-hidden">
                    <div class="whitespace-nowrap transition-transform duration-500"
                        :style="'transform: translateX(-' + (100 * (activeSlide - 1)) + '%)'">
                        <!-- Project1 -->
                        @foreach ($projects as $project)
                            <div class="inline-block w-full border border-solid border-gray-500 rounded"
                                x-for="slide in slides" :key="slide">
                                <img src="{{ $project->thumbnail_image }}" alt="Project Image"
                                    class="w-full object-cover" style="height: 400px;">
                                <div class="text-center mt-4">
                                    <h3 class="text-xl font-semibold">{{ $project->name }}</h3>
                                    <p class="text-gray-600 mt-2">{{ $project->description }}</p>
                                </div>
                            </div>
                        @endforeach
                        <!-- End of project block -->
                    </div>
                </div>

                <!-- Controls -->
                <div class="flex justify-center mt-4">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button :class="{ 'bg-gray-800': activeSlide === slide, 'bg-gray-300': activeSlide !== slide }"
                            class="h-3 w-3 rounded-full mx-2 focus:outline-none" @click="activeSlide = slide"></button>
                    </template>
                </div>
            </div>
        </div>
    </section>
@endif
