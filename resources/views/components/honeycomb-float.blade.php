<div x-data="{ mouseX: 0, mouseY: 0 }" @mousemove.window="mouseX = $event.clientX; mouseY = $event.clientY" class="min-h-screen">

    {{ $slot }}

    <!-- Floating Images Component -->
    <div>
        <!-- Images here follow the same pattern as before, using the global mouseX and mouseY -->
        <img :style="'transform: translate3d(' + (mouseX / -30) + 'px, ' + (mouseY / -30) + 'px, 0)'"
            src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-6/12 h-6/12 top-24 left-10 z-30" />
        <img :style="'transform: translate3d(' + (mouseX / -30) + 'px, ' + (mouseY / -30) + 'px, 0)'"
            src="/images/honeycomb.png" alt="Interactive Honeycomb"
            class="fixed w-2/12 h-2/12 bottom-1/4 right-3/4 z-10" />
        <img :style="'transform: translate3d(' + (mouseX / -17) + 'px, ' + (mouseY / -17) + 'px, 0)'"
            src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-5/12 h-5/12 top-3/4 right-3/4 z-30" />

        {{-- Mid --}}
        <img :style="'transform: translate3d(' + (mouseX / -18) + 'px, ' + (mouseY / -18) + 'px, 0)'"
            src="/images/honeycomb.png" alt="Interactive Honeycomb"
            class="fixed w-3/12 h-3/12 bottom-12 left-1/4 z-10" />
        <img :style="'transform: translate3d(' + (mouseX / -20) + 'px, ' + (mouseY / -20) + 'px, 0)'"
            src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-4/12 h-4/12 top-1/3 right-20 z-10" />

        <img :style="'transform: translate3d(' + (mouseX / -20) + 'px, ' + (mouseY / -20) + 'px, 0)'"
            src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-4/12 h-4/12 top-11 left-1/3 z-10" />
        {{-- Right --}}
        <img :style="'transform: translate3d(' + (mouseX / -30) + 'px, ' + (mouseY / -30) + 'px, 0)'"
            src="/images/honeycomb.png" alt="Interactive Honeycomb"
            class="fixed w-2/12 h-2/12 bottom-24 -right-6 z-10" />
        <img :style="'transform: translate3d(' + (mouseX / -25) + 'px, ' + (mouseY / -25) + 'px, 0)'"
            src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-3/12 h-3/12 top-12 -right-14 z-10" />
        {{-- Front most --}}
        <img :style="'transform: translate3d(' + (mouseX / -8) + 'px, ' + (mouseY / -8) + 'px, 0)'"
            src="/images/honeycomb.png" alt="Interactive Honeycomb" class="fixed w-8/12 h-8/12 top-2/3 left-1/3 z-30" />
    </div>
</div>
