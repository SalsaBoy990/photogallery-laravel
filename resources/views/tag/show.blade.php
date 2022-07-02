@extends('layouts.main')

@section('title')
<div class="w-full px-4 pt-0 pb-4 dark:bg-gray-800">

    <x-breadcrumb :indexPage="'Címke részletek'" :pageTitle="$tag->name" :indexPageRoute="'tag.index'">
    </x-breadcrumb>

    <div class="flex justify-center">
        <div class="flex w-full flex-row rounded-lg bg-white shadow-lg">
            <div class="p-6">
                <h2 class="mb-3 text-left font-serif text-2xl font-bold">{{ $tag->name }}</h2>
                <div class="mb-4 text-base text-gray-700">
                    {{-- Mews\Purifier cleans html --}}
                    {!! $tag->description !!}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


@section('content')
<div class="mb-10 w-full overflow-hidden bg-white shadow dark:bg-gray-800 sm:rounded-sm">

    <div class="mb-3 px-4 pt-4">

        @if ($msg = Session::get('success'))
        <div class="alert alert-dismissible fade show mb-3 inline-flex w-full items-center rounded-lg bg-yellow-100 py-5 px-6 text-base text-yellow-700"
            role="alert">
            {{ $msg }}
            <button type="button"
                class="btn-close ml-auto box-content h-4 w-4 rounded-none border-none p-1 text-yellow-900 opacity-50 hover:text-yellow-900 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

    </div>

</div>
@endsection