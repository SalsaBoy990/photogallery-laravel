@extends('layouts.app')

@section('title')
    <x-breadcrumb :indexPage="'Bakancslista'" :pageTitle="$goal->order . '. ' . $goal->title" :indexPageRoute="'goal.index'">
    </x-breadcrumb>
@endsection


@section('content')
    <x-card :size="'3/4'">

        <div class="flex justify-center">
            <div class="flex w-full flex-row rounded-lg bg-white shadow-lg">
                <div class="p-6">
                    <h5 class="mb-3 text-left font-serif text-3xl font-bold">{{ $goal->title }}</h5>
                    <p class="mb-5">
                        @if ($goal->completed)
                            <span><i class="fa-solid fa-square-check mr-1 text-emerald-300"></i>
                                {{ __('Megvalósítva') }}</span>
                        @else
                            <span><i class="fa-solid fa-triangle-exclamation mr-1 text-rose-300"></i>
                                {{ __('Teljesítendő') }}</span>
                        @endif
                    </p>

                    <div class="mb-4 text-base text-gray-700">
                        {{-- Mews\Purifier cleans html --}}
                        {!! $goal->description !!}
                    </div>

                    <div class="block">
                        <div class="flex flex-row gap-x-2">
                            <x-submit-button :linkText="__('Edit')"></x-submit-button>
                            <x-link :route="URL::previous() === URL::current() ? route('goal.index') : URL::previous()" :linkText="__('Go back')"></x-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-card>
@endsection
