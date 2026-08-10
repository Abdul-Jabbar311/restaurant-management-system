@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="bg-white rounded-lg shadow p-6">

        <h1 class="text-3xl font-bold mb-6">
            Edit Permission
        </h1>

        @if ($errors->any())

            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">

                <ul class="list-disc pl-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('permissions.update',$permission) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Permission Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name',$permission->name) }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Module
                </label>

                <select
                    name="module"
                    class="w-full border rounded-lg p-3">

                    @php

                    $modules = [
                        'Users',
                        'Roles',
                        'Categories',
                        'Menu Items',
                        'Customers',
                        'Orders',
                        'Reservations',
                        'Kitchen',
                        'Inventory',
                        'Ingredients',
                        'Suppliers',
                        'Expenses',
                        'Attendance',
                        'Reports',
                        'Settings',
                        'Notifications'
                    ];

                    @endphp

                    @foreach($modules as $module)

                    <option value="{{ $module }}"
                        {{ $permission->module == $module ? 'selected' : '' }}>

                        {{ $module }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">

                    Update

                </button>

                <a href="{{ route('permissions.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection