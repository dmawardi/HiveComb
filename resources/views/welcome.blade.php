<x-layout>
    <x-slot name="title">HiveComb - Expert Web Development Agency</x-slot>
    <meta name="description" 
    content="HiveComb is a web development agency that crafts modern, high-performance websites tailored to your business needs. Elevate your online presence with our expertise." />
    <x-honeycomb-float>
        <x-hero-section></x-hero-section>
        <x-about-section></x-about-section>
        <x-services-section></x-services-section>
        <x-portfolio :projects="$projects"></x-portfolio>
        <x-process-section></x-process-section>
        <x-call-to-action></x-call-to-action>
    </x-honeycomb-float>
</x-layout>
