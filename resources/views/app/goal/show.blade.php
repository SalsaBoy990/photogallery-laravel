@extends('layouts.app')

@section('title')
    <x-breadcrumb :indexPage="__('Bucket list')" :pageTitle="$goal->title" :indexPageRoute="'goal.index'">
    </x-breadcrumb>
@endsection


@section('content')
    <x-card :size="'3/4'">

        <div class="p-4">
            <h5 class="mb-3 text-left font-serif text-3xl font-bold">{{ $goal->title }}</h5>
            <p class="mb-5">
                @if ($goal->completed)
                    <span><i class="fa-solid fa-square-check mr-1 text-emerald-300"></i>
                        {{ __('Completed') }}</span>
                @else
                    <span><i class="fa-solid fa-triangle-exclamation mr-1 text-rose-300"></i>
                        {{ __('To be completed') }}</span>
                @endif
            </p>

            <div class="mb-4 text-base text-gray-700">
                {{-- Mews\Purifier cleans html --}}
                {!! $goal->description !!}
            </div>

            <div class="block">
                <div class="flex flex-row gap-x-2">
                    <x-link :route="route('goal.edit', $goal->id)" :linkText="__('Edit')"></x-link>
                    <x-link :route="route('goal.index')" :linkText="__('Back')" :linkType="'secondary'"></x-link>
                </div>
            </div>
        </div>

    </x-card>
@endsection
