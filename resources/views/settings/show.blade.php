@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6 max-w-3xl">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">
            Restaurant Settings
        </h2>

        <a href="{{ route('settings.edit', $setting->id) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Edit
        </a>
    </div>

    <div class="space-y-4">

        <div>
            <p class="text-gray-500">Restaurant Name</p>
            <p class="font-semibold">{{ $setting->restaurant_name }}</p>
        </div>

        <div>
            <p class="text-gray-500">Phone</p>
            <p class="font-semibold">{{ $setting->phone }}</p>
        </div>

        <div>
            <p class="text-gray-500">Email</p>
            <p class="font-semibold">{{ $setting->email }}</p>
        </div>

        <div>
            <p class="text-gray-500">Address</p>
            <p class="font-semibold">{{ $setting->address }}</p>
        </div>

        <div>
            <p class="text-gray-500">Tax Percentage</p>
            <p class="font-semibold">{{ $setting->tax_percentage }}%</p>
        </div>

        <div>
            <p class="text-gray-500">Currency</p>
            <p class="font-semibold">{{ $setting->currency }}</p>
        </div>

    </div>

    <div class="mt-6">
        <a href="{{ route('settings.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Back
        </a>
    </div>

</div>

@endsection