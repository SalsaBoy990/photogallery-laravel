@extends('layouts.app')

@section('title')
    @if ($notification = Session::get('notification'))
        <x-notification :message="$notification['message']" :type="$notification['type']"></x-notification>
    @endif
@endsection


@section('content')
    <x-card :size="'3/4'">

        <h1 class="mb-3 border-b border-b-gray-200 pb-3 text-left font-serif text-4xl font-bold">
            {{ __('All tags') }}
            <span class="text-base font-normal text-gray-700">({{ count($tags) }})</span>
        </h1>

        <div class="container mx-auto space-y-2 lg:space-y-0">

            <div class="block pb-5">
                <x-link :route="route('tag.create')" :linkText="__('New tag')" :iconName="'plus'"></x-link>
            </div>

            <div class="flex justify-center">
                <ul class="w-full rounded-lg bg-white text-gray-900">
                    @foreach ($tags as $tag)
                        <li class="{{ $loop->index === 0 ? 'py-6' : 'border-t border-gray-200 py-6' }}">
                            <div class="flex flex-row justify-between">
                                <div class="flex flex-row items-baseline">
                                    <h2 class="mb-2 mr-2 text-xl font-bold text-gray-900">
                                        {{ $tag->name }}
                                    </h2>
                                    <div class="text-sm italic">({{ $tag->galleries->count() . ' ' . __('gallery') }})
                                    </div>
                                </div>

                                <div class="flex h-8 gap-2" role="group">
                                    <form action="{{ route('tag.destroy', $tag->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <x-delete-button :title="__('Delete')" :iconName="'trash-can'">
                                        </x-delete-button>
                                    </form>

                                    <x-link :route="route('tag.edit', $tag->id)" :title="__('Edit')" :iconName="'pencil'" :linkType="'icon'">
                                    </x-link>
                                    <x-link :route="route('tag.show', $tag->id)" :title="__('Show details')" :iconName="'eye'" :linkType="'icon'">
                                    </x-link>

                                </div>
                            </div>

                            <div class="flex flex-row">
                                <div class="max-w-md text-gray-700">
                                    {{-- Mews\Purifier cleans html --}}
                                    {!! $tag->description !!}
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>

        </div>
    </x-card>
@endsection
