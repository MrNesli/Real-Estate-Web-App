<x-app-layout>
    @include('components.sections.header')
    @include('components.sections.contact')
    @include('components.sections.properties')
    @include('components.sections.footer')
    @push('scripts')
        @vite([
            'resources/js/reservation/form.js',
            'resources/js/reservation/buttons.js'
        ])
    @endpush
</x-app-layout>

