<x-app-layout>

    @section('title')
    <div class="w-full pt-0 pr-4 pl-4 pb-4">
        @if ($notification = Session::get('notification'))
        <x-notification :message="$notification['message']" :type="$notification['type']">
        </x-notification>
        @endif
        <h1 class="text-left font-serif text-4xl font-bold pt-2">{{ __('Manage registered users') }}</h1>
    </div>
    @endsection

    @section('content')
        <x-card :height="'onboarding-card-height justify-center items-center flex flex-col'">
            <button>{{ __('Delete user') }}</button>

            <form action="">
                <button>{{ __('Add new user') }}</button>
            </form>
        </x-card>
    @endsection
</x-app-layout>
