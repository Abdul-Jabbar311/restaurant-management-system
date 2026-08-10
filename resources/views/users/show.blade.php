@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-8">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            User Details
        </h1>

        <a href="{{ route('users.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">

            Back

        </a>

    </div>

    <div class="flex items-center gap-8 mb-8">

        @if($user->profile_image)

            <img
                src="{{ asset('storage/'.$user->profile_image) }}"
                class="w-32 h-32 rounded-full object-cover">

        @else

            <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center">

                No Image

            </div>

        @endif

        <div>

            <h2 class="text-2xl font-bold">

                {{ $user->name }}

            </h2>

            <p class="text-gray-600">

                {{ $user->role->name }}

            </p>

            @if($user->is_active)

                <span class="inline-block mt-2 bg-green-100 text-green-700 px-3 py-1 rounded">

                    Active

                </span>

            @else

                <span class="inline-block mt-2 bg-red-100 text-red-700 px-3 py-1 rounded">

                    Inactive

                </span>

            @endif

        </div>

    </div>

    <div class="grid grid-cols-2 gap-6">

        <div>

            <label class="font-semibold">

                Name

            </label>

            <p>

                {{ $user->name }}

            </p>

        </div>

        <div>

            <label class="font-semibold">

                Email

            </label>

            <p>

                {{ $user->email }}

            </p>

        </div>

        <div>

            <label class="font-semibold">

                Phone

            </label>

            <p>

                {{ $user->phone ?? 'N/A' }}

            </p>

        </div>

        <div>

            <label class="font-semibold">

                Role

            </label>

            <p>

                {{ $user->role->name }}

            </p>

        </div>

        <div>

            <label class="font-semibold">

                Status

            </label>

            <p>

                {{ $user->is_active ? 'Active' : 'Inactive' }}

            </p>

        </div>

        <div>

            <label class="font-semibold">

                Created At

            </label>

            <p>

                {{ $user->created_at->format('d M Y h:i A') }}

            </p>

        </div>

    </div>

    <div class="mt-8">

        <a href="{{ route('users.edit',$user) }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">

            Edit User

        </a>

    </div>

</div>

@endsection