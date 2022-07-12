@extends('layouts.app')

@php
@endphp

@section('title')
    @if ($msg = Session::get('success'))
        <x-success-alert :message="$msg"></x-success-alert>
    @endif
@endsection


@section('content')
    <div class="mb-10 w-full bg-white p-4 shadow dark:bg-gray-800 sm:rounded-sm md:w-full lg:w-3/4">

        <div class="flex flex-row items-center justify-between border-b border-b-gray-200">

            <h1 class="mb-3 text-left font-serif text-4xl font-bold">
                Bakancslista
            </h1>

            <div>
                <span class="text-sm font-normal text-gray-700">Teljesítve:
                    {{ $completed }}/{{ count($goals) }}</span>
                </span>
                <div class="h-4 w-40 rounded-full bg-gray-200">
                    <div class="rounded-l-full bg-green-600 p-0.5 text-center text-xs font-medium leading-none text-green-100"
                        style="width: {{ $percentage }}%"> {{ $percentage }}%</div>
                </div>
            </div>

        </div>


        <div class="container mx-auto space-y-2 lg:space-y-0">

            <div class="py-3">
                <x-link :route="route('goal.create')" :linkText="__('New goal')" :iconName="'plus'"></x-link>
            </div>

            <div class="flex justify-center">
                <ul class="w-full rounded-lg bg-white text-gray-900">

                    @foreach ($goals as $goal)
                        <li class="{{ $loop->index === 0 ? 'py-6' : 'border-t border-gray-200 py-6' }}">
                            <div class="flex flex-row justify-between">
                                <h2 class="mb-3 text-xl font-bold">
                                    {{ $loop->index + 1 . '. ' . $goal->title }}
                                    @if ($goal->completed)
                                        <i class="fa-solid fa-square-check text-emerald-300"></i>
                                    @else
                                        <i class="fa-solid fa-triangle-exclamation text-rose-300"></i>
                                    @endif
                                </h2>

                                <div class="flex h-8 gap-2" role="group">
                                    <form action="{{ route('goal.destroy', $goal->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf

                                        <x-delete-button :title="__('Delete goal')">
                                        </x-delete-button>

                                    </form>

                                    <x-link :route="route('goal.edit', $goal->id)" :title="__('Edit goal')" :iconName="'pencil'" :linkType="'icon'">
                                    </x-link>
                                    <x-link :route="route('goal.show', $goal->id)" :title="__('Show details')" :iconName="'eye'" :linkType="'icon'">
                                    </x-link>
                                </div>
                            </div>

                            <div class="flex flex-row">
                                <div class="max-w-md text-gray-700">
                                    {{-- Mews\Purifier cleans html --}}
                                    {!! $goal->description !!}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
