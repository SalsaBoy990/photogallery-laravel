<x-app-layout>

    @section('title')
        <div class="w-full pt-0 pr-4 pl-4 pb-4">
            @if ($notification = Session::get('notification'))
                <x-notification :message="$notification['message']" :type="$notification['type']">
                </x-notification>
            @endif
            <h1 class="pt-2 text-left font-serif text-4xl font-bold">{{ __('Manage registered users') }}
            </h1>
        </div>
    @endsection

    @section('content')
        <x-card :height="'justify-center items-left flex flex-col'">

            <div class="py-3">
                <x-link :route="route('admin.create')" :linkText="__('New user')" :iconName="'plus'"></x-link>
            </div>

            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="inline-block max-w-full">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="border-b">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-600">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-600">
                                            {{ __('Avatar') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-600">
                                            {{ __('Name') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-600">
                                            {{ __('Email') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-600">
                                            {{ __('Registration') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-600">
                                            {{ __('Role') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-600">
                                            {{ __('Sex') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="border-b">
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                                {{ $user->id }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                                @if ($user->avatar_image)
                                                    <img src="{{ '/file/' . $user->id . '/' . $user->avatar_image }}"
                                                        alt="{{ $user->name }}" class="h-16 w-16 rounded-full"
                                                        style="max-width: unset;">
                                                @elseif ($user->sex === 'male')
                                                    <img class="mb-2 h-16 w-16 rounded-full" style="max-width: unset;"
                                                        src="{{ asset('storage/images/avatar-male.png') }}"
                                                        alt="{{ $user->name }}">
                                                @else
                                                    <img class="mb-2 h-16 w-16 rounded-full" style="max-width: unset;"
                                                        src="{{ asset('storage/images/avatar-female.png') }}"
                                                        alt="{{ $user->name }}">
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-bold text-gray-900">
                                                {{ $user->name }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-normal text-gray-900">
                                                {{ $user->email }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-normal text-gray-900">
                                                {{ $user->created_at->diffForHumans() }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-normal text-gray-900">
                                                {{ $user->role === 'admin' ? __('admin') : __('customer') }}

                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-normal text-gray-900">
                                                {{ $user->sex === 'male' ? __('male') : __('female') }}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-normal text-gray-900">
                                                @if ($user->role !== 'admin')
                                                    <div class="flex h-8 gap-2" role="group">
                                                        @php
                                                            $confirmMsg = __('Are you sure you want to delete :name?', ['name' => $user->name]);
                                                        @endphp
                                                        <form action="{{ route('user.destroy', $user->id) }}"
                                                            method="POST"
                                                            onSubmit="{{ 'return confirm("' . $confirmMsg . '");' }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <x-delete-button :title="__('')" :iconName="'trash-can'">
                                                            </x-delete-button>
                                                        </form>

                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="pt-12">
                    {{ $users->links() }}
                </div>
        </x-card>
    @endsection
</x-app-layout>
