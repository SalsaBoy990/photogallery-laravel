<x-app-layout>

    @section('title')
    @endsection

    @section('content')
        <x-card :height="'onboarding-card-height justify-center items-center flex flex-col'">
            <h1 class="mb-3 border-b border-b-gray-200 pb-3 text-center font-serif text-4xl font-bold">
                {{ __('Welcome! Create your first gallery to get started!') }}
            </h1>

            <div class="w-full rounded text-center">
                <x-link :route="route('gallery.create')" :iconName="'plus'" :linkText="__('Create a gallery')"></x-link>
            </div>
        </x-card>
    @endsection
</x-app-layout>
