<!-- Hero Section -->
<div x-data="{ mouseX: 0, mouseY: 0 }" @mousemove="mouseX = $event.clientX; mouseY = $event.clientY"
    class="block h-screen bg-violet-800 overflow-hidden">
    <!-- Interactive Background -->
    <!-- Add animated/interactive elements here, like floating combs or honey-like blobs -->

    <!-- Interactive Honeycomb Image -->

    {{-- Left --}}
    <img :style="'transform: translate3d(' + (mouseX / -14) + 'px, ' + (mouseY / -14) + 'px, 0)'"
        src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-6/12 h-6/12 top-24 left-10 z-30" />
    <img :style="'transform: translate3d(' + (mouseX / -30) + 'px, ' + (mouseY / -30) + 'px, 0)'"
        src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-2/12 h-2/12 bottom-1/4 right-3/4 z-10" />

    {{-- Mid --}}
    <img :style="'transform: translate3d(' + (mouseX / -18) + 'px, ' + (mouseY / -18) + 'px, 0)'"
        src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-3/12 h-3/12 bottom-12 left-1/4 z-10" />
    <img :style="'transform: translate3d(' + (mouseX / -20) + 'px, ' + (mouseY / -20) + 'px, 0)'"
        src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-4/12 h-4/12 top-1/3 right-44 z-10" />
    <img :style="'transform: translate3d(' + (mouseX / -17) + 'px, ' + (mouseY / -17) + 'px, 0)'"
        src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-5/12 h-5/12 top-3/4 right-3/4 z-30" />
    <img :style="'transform: translate3d(' + (mouseX / -20) + 'px, ' + (mouseY / -20) + 'px, 0)'"
        src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-4/12 h-4/12 top-11 left-1/3 z-10" />
    {{-- Right --}}
    <img :style="'transform: translate3d(' + (mouseX / -30) + 'px, ' + (mouseY / -30) + 'px, 0)'"
        src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-2/12 h-2/12 bottom-24 -right-6 z-10" />
    <img :style="'transform: translate3d(' + (mouseX / -25) + 'px, ' + (mouseY / -25) + 'px, 0)'"
        src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-3/12 h-3/12 top-12 -right-14 z-10" />
    {{-- Front most --}}
    <img :style="'transform: translate3d(' + (mouseX / -8) + 'px, ' + (mouseY / -8) + 'px, 0)'"
        src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-8/12 h-8/12 top-2/3 left-1/3 z-30" />


    <!-- Content -->
    <div class="flex items-center justify-center h-full">
        <div class="text-center z-40">
            <h1 class="text-6xl font-bold text-gray-500">
                Crafting Digital Experiences
            </h1>
            <p class="text-2xl mt-4 text-bold text-amber-500">
                Innovative web solutions tailored to bring your brand to life.
            </p>
            <a href="#projects"
                class="mt-8 inline-block bg-yellow-400 text-gray-800 font-bold py-3 px-6 rounded-lg transform transition-all hover:scale-110">
                See Our Work
            </a>
        </div>
    </div>
</div>
