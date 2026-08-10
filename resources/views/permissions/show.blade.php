@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="bg-white rounded-lg shadow p-6">

        <h1 class="text-3xl font-bold mb-6">
            Permission Details
        </h1>

        <div class="mb-5">

            <label class="font-semibold">
                ID
            </label>

            <p class="mt-1">
                {{ $permission->id }}
            </p>

        </div>

        <div class="mb-5">

            <label class="font-semibold">
                Permission Name
            </label>

            <p class="mt-1">
                {{ $permission->name }}
            </p>

        </div>

        <div class="mb-5">

            <label class="font-semibold">
                Module
            </label>

            <p class="mt-1">
                {{ $permission->module }}
            </p>

        </div>

        <div class="mb-5">

            <label class="font-semibold">
                Created At
            </label>

            <p class="mt-1">
                {{ $permission->created_at }}
            </p>

        </div>

        <div class="flex gap-3">

            <a href="{{ route('permissions.edit',$permission) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">

                Edit

            </a>

            <a href="{{ route('permissions.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">

                Back

            </a>

        </div>

    </div>

</div>

@endsection