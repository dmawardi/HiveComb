@props(['background' => 'bg-amber-400', 'titleTextColor' => 'text-violet-800', 'textColor' => 'text-gray-600'])
<section id="process" class="py-16 {{ $background }}">
    <div class="container mx-auto px-4 relative z-40">
        <h2 class="text-3xl font-bold text-center {{ $titleTextColor }}">Our Process & Methodology</h2>
        <p class="text-lg text-center {{ $textColor }} mt-4">From initial concept to final launch, our process ensures
            quality and satisfaction.</p>

        <div
            class="mt-8 flex flex-col md:flex-row justify-center items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
            <!-- Step 1: Research -->
            <div class="flex flex-col items-center">
                <div class="flex items-center justify-center w-20 h-20 bg-purple-500 rounded-full text-white">
                    <!-- Replace with your icon -->
                    <i class="fa-brands fa-searchengin fa-3x text-gray-200"></i>
                </div>
                <h3 class="mt-4 text-xl font-semibold {{ $titleTextColor }}">Research</h3>
                <p class="text-center {{ $textColor }} mt-2">Understanding your market and user needs to inform our
                    design
                    and development.</p>
            </div>

            <!-- Step 2: Design -->
            <div class="flex flex-col items-center">
                <div class="flex items-center justify-center w-20 h-20 bg-purple-500 rounded-full text-white">
                    <!-- Replace with your icon -->
                    <i class="fa-solid fa-palette fa-3x text-gray-200"></i>
                </div>
                <h3 class="mt-4 text-xl font-semibold {{ $titleTextColor }}">Design</h3>
                <p class="text-center {{ $textColor }} mt-2">Crafting user-centric designs that resonate with your
                    audience
                    and drive engagement.</p>
            </div>

            <!-- Step 3: Development -->
            <div class="flex flex-col items-center">
                <div class="flex items-center justify-center w-20 h-20 bg-purple-500 rounded-full text-white">
                    <!-- Replace with your icon -->
                    <i class="fa-solid fa-hammer fa-3x text-gray-200"></i>
                </div>
                <h3 class="mt-4 text-xl font-semibold {{ $titleTextColor }}">Development</h3>
                <p class="text-center {{ $textColor }} mt-2">Building robust, scalable solutions using the latest
                    technologies.</p>
            </div>

            <!-- Step 4: Testing -->
            <div class="flex flex-col items-center">
                <div class="flex items-center justify-center w-20 h-20 bg-purple-500 rounded-full text-white">
                    <!-- Replace with your icon -->
                    <i class="fa-solid fa-vial-circle-check fa-3x text-gray-200"></i>
                </div>
                <h3 class="mt-4 text-xl font-semibold {{ $titleTextColor }}">Testing</h3>
                <p class="text-center {{ $textColor }} mt-2">Ensuring the highest quality through comprehensive
                    testing and
                    quality assurance.</p>
            </div>

            <!-- Step 5: Launch -->
            <div class="flex flex-col items-center">
                <div class="flex items-center justify-center w-20 h-20 bg-purple-500 rounded-full text-white">
                    <!-- Replace with your icon -->
                    <i class="fa-solid fa-rocket fa-3x text-gray-200"></i>
                </div>
                <h3 class="mt-4 text-xl font-semibold {{ $titleTextColor }}">Launch</h3>
                <p class="text-center {{ $textColor }} mt-2">Deploying your project to the world, ready for users to
                    experience.</p>
            </div>
        </div>
    </div>
</section>
