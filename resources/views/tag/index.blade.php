@extends('layouts.main')

@php
@endphp

@section('title')
<div class="w-full p-4 dark:bg-gray-800">
    @if ($msg = Session::get('success'))
    <div class="alert alert-dismissible fade show mb-3 inline-flex w-full items-center rounded-lg bg-emerald-100 py-5 px-6 text-base text-gray-700"
        role="alert">
        {!! $msg !!}
        <button type="button"
            class="btn-close ml-auto box-content h-4 w-4 rounded-none border-none p-1 text-gray-700 opacity-50 hover:text-gray-900 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
            data-bs-dismiss="alert" aria-label="Bezár"></button>
    </div>
    @endif
    <h1 class="text-left font-serif text-4xl font-bold">{{ __('Összes címke') }}</h1>
</div>
@endsection


@section('content')
<div class="mt-4 mb-10 w-full overflow-hidden bg-white p-4 shadow dark:bg-gray-800 sm:rounded-sm">

    <div class="container mx-auto space-y-2 lg:space-y-0">

        <div class="mb-5 border-b border-b-gray-200">
            <div class="text-sm text-gray-700">{{ __('Címkék összes száma: ') }}
                <span>{{ count($tags) }}</span>
            </div>
        </div>

        <div class="block pb-5">
            <a href="{{ route('tag.create') }}" role="button"
                class="inline-block rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg"><i
                    class="fas fa-plus"></i> {{ __('Új címke') }}</a>
        </div>

        <div class="lg:grid-cols:4 grid w-full grid-cols-1 gap-4
                    rounded-lg bg-white text-gray-900 sm:grid-cols-3 md:grid-cols-3">
            @foreach ($tags as $tag)
            <div class="max-w-sm rounded-lg bg-amber-50 shadow-lg">
                <div class="p-6">
                    <h2 class="mb-2 text-xl font-medium text-gray-900">{{ $tag->name }}</h2>
                    <div class="mb-4 text-base text-gray-700">
                        {{-- Mews\Purifier cleans html --}}
                        {!! $tag->description !!}
                    </div>
                    <div class="flex h-8 justify-end" role="group">
                        <form action="{{ route('tag.destroy', $tag->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button title="Címke törlése" type="submit"
                                class="rounded-r border-2 border-rose-600 px-2 py-2 text-xs font-medium uppercase leading-tight text-rose-600 transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0">
                                <i class="fa-solid fa-trash-can"></i></button>
                        </form>
                        <a href="{{ route('tag.edit', $tag->id) }}" title="Címke szerkesztése" role="button"
                            class="rounded-r border-2 border-blue-600 px-2 py-2 text-xs font-medium uppercase leading-tight text-blue-600 transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <a href="{{ route('tag.show', $tag->id) }}" title="Részletek mutatása" role="button"
                            class="rounded-r border-2 border-blue-600 px-2 py-2 text-xs font-medium uppercase leading-tight text-blue-600 transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection