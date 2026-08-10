@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Restaurant Tables
            </h1>

            <p class="text-gray-500 mt-1">
                Manage restaurant tables and their current status.
            </p>
        </div>

        <a href="{{ route('restaurant-tables.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold shadow">
            + Add Table
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-5">
            {{ session('success') }}
        </div>

    @endif


    {{-- Search --}}
    <div class="bg-white rounded-xl shadow p-5 mb-6">

        <form action="{{ route('restaurant-tables.index') }}"
              method="GET"
              class="flex gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search Table..."
                class="border border-gray-300 rounded-lg px-4 py-2.5 w-80 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold">
                Search
            </button>

            <a href="{{ route('restaurant-tables.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2.5 rounded-lg font-semibold">
                Reset
            </a>

        </form>

    </div>


    {{-- Tables --}}
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100 border-b">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold text-gray-700">
                            Table
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-gray-700">
                            Capacity
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-gray-700">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center font-semibold text-gray-700">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($tables as $table)

                        <tr class="border-b hover:bg-gray-50">

                            {{-- Table Number --}}
                            <td class="px-6 py-4 font-semibold text-gray-800">

                                {{ $table->table_number }}

                                @if($table->table_name)

                                    <div class="text-sm text-gray-500 font-normal">
                                        {{ $table->table_name }}
                                    </div>

                                @endif

                            </td>


                            {{-- Capacity --}}
                            <td class="px-6 py-4 text-gray-700">

                                👥 {{ $table->capacity }}

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if($table->status == 'Available')

                                    <span class="inline-flex items-center bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        🟢 Available
                                    </span>


                                @elseif($table->status == 'Reserved')

                                    <span class="inline-flex items-center bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        🟡 Reserved
                                    </span>


                                @elseif($table->status == 'Cleaning')

                                    <div class="flex flex-col items-start gap-2">

                                        <span class="inline-flex items-center bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            🟠 Cleaning
                                        </span>

                                        <form
                                            action="{{ route('restaurant-tables.available', $table) }}"
                                            method="POST">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-sm font-semibold">

                                                ✔ Cleaning Complete

                                            </button>

                                        </form>

                                    </div>


                                @else

                                    <span class="inline-flex items-center bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        🔴 Occupied
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('restaurant-tables.show', $table) }}"
                                        class="bg-green-600 hover:bg-green-700 text-white w-10 h-10 rounded-lg flex items-center justify-center"
                                        title="View">

                                        👁

                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('restaurant-tables.edit', $table) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white w-10 h-10 rounded-lg flex items-center justify-center"
                                        title="Edit">

                                        ✏️

                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('restaurant-tables.destroy', $table) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this table?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white w-10 h-10 rounded-lg flex items-center justify-center"
                                            title="Delete">

                                            🗑️

                                        </button>

                                    </form>


                                    {{-- QR Code --}}
                                    @if($table->qr_code)

                                        <a
                                            href="{{ asset($table->qr_code) }}"
                                            target="_blank"
                                            class="bg-blue-600 hover:bg-blue-700 text-white w-10 h-10 rounded-lg flex items-center justify-center"
                                            title="View QR Code">

                                            📱

                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center py-10 text-gray-500">

                                <div class="text-4xl mb-3">
                                    🍽️
                                </div>

                                <p class="font-semibold">
                                    No Tables Found
                                </p>

                                <p class="text-sm mt-1">
                                    Add a restaurant table to get started.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Pagination --}}
    <div class="mt-6">

        {{ $tables->withQueryString()->links() }}

    </div>

</div>

@endsection