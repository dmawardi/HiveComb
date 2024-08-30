@props(['title' => '', 'text' => '', 'icon' => 'fa-solid fa-palette'])
<div class="bg-gray-800 opacity-90 py-8 rounded-md">
    <i class="{{ $icon }} fa-3x text-gray-200 mb-4"></i>
    <h3 class="text-xl font-semibold mb-2 text-gray-100">{{ $title }}</h3>
    <p class="text-gray-200">
        {{ $text }}
    </p>
</div>
