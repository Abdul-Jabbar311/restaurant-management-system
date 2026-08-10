@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-lg shadow p-6">

        <h1 class="text-3xl font-bold mb-6">
            Role Details
        </h1>

        <div class="mb-5">

            <label class="font-semibold text-gray-700">
                Role Name
            </label>

            <p class="mt-2 text-lg">
                {{ $role->name }}
            </p>

        </div>

        <div class="mb-5">

            <label class="font-semibold text-gray-700">
                Description
            </label>

            <p class="mt-2">
                {{ $role->description ?? 'N/A' }}
            </p>

        </div>

        <div class="mb-6">

            <label class="font-semibold text-gray-700">
                Assigned Permissions
            </label>

            <div class="mt-3">

                @forelse($role->permissions as $permission)

                    <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm mr-2 mb-2">

                        {{ $permission->name }}

                    </span>

                @empty

                    <p class="text-gray-500">

                        No permissions assigned.

                    </p>

                @endforelse

            </div>

        </div>

        <div class="mb-5">

            <label class="font-semibold text-gray-700">
                Created At
            </label>

            <p class="mt-2">
                {{ $role->created_at }}
            </p>

        </div>

        <div class="flex gap-3 mt-6">

            <a href="{{ route('roles.edit',$role) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">

                Edit

            </a>

            <a href="{{ route('roles.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">

                Back

            </a>

        </div>

    </div>

</div>

@endsection