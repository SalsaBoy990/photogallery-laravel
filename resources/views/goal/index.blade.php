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
    <h1 class="text-left font-serif text-4xl font-bold">Bakancslista</h1>
</div>
@endsection


@section('content')
<div class="w-half mt-4 mb-10 overflow-hidden bg-white p-4 shadow dark:bg-gray-800 sm:rounded-sm">

    <div class="container mx-auto space-y-2 lg:space-y-0">

        <div class="mb-5 border-b border-b-gray-200">
            <div class="text-sm text-gray-700">Teljesítve eddig:
                <span>{{ $completed }}/{{ count($goals) }}</span><span> ({{ $percentage }}%)</span>
            </div>
        </div>

        <div class="flex justify-center">
            <ul class="w-full rounded-lg bg-white text-gray-900">

                @foreach ($goals as $goal)
                <li class="border-b border-gray-200 py-4">
                    <div class="flex justify-between sm:flex-col md:flex-row lg:flex-row">
                        <div class="flex flex-row">

                            <div class="w-px-32 flex flex-col justify-evenly justify-items-stretch">
                                <button class="text-gray-500"><i class="fa-solid fa-caret-up"></i></button>
                                <button class="text-gray-500"><i class="fa-solid fa-caret-down"></i></button>
                            </div>

                            <div class="w-96">
                                <h2 class="mb-3 font-serif text-xl font-bold">
                                    {{ $loop->index + 1 . '. ' . $goal->title }}
                                    @if ($goal->completed)
                                    <i class="fa-solid fa-square-check text-emerald-300"></i>
                                    @else
                                    <i class="fa-solid fa-triangle-exclamation text-rose-300"></i>
                                    @endif
                                </h2>
                                <div class="text-gray-700">
                                    {{-- Mews\Purifier cleans html --}}
                                    {!! $goal->description !!}
                                </div>
                            </div>

                        </div>

                        <div class="flex h-8 justify-end" role="group">
                            <form action="{{ route('goal.destroy', $goal->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button title="Célkitűzés törlése" type="submit"
                                    class="rounded-r border-2 border-rose-600 px-2 py-2 text-xs font-medium uppercase leading-tight text-rose-600 transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                            <a href="{{ route('goal.edit', $goal->id) }}" title="Célkitűzés szerkesztése" role="button"
                                class="rounded-r border-2 border-blue-600 px-2 py-2 text-xs font-medium uppercase leading-tight text-blue-600 transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <a href="{{ route('goal.show', $goal->id) }}" title="Részletek mutatása" role="button"
                                class="rounded-r border-2 border-blue-600 px-2 py-2 text-xs font-medium uppercase leading-tight text-blue-600 transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>

                </li>
                @endforeach

            </ul>

        </div>
        <a href="{{ route('goal.create') }}" role="button"
            class="inline-block rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg"><i
                class="fas fa-plus"></i> Új</a>

    </div>
</div>
@endsection