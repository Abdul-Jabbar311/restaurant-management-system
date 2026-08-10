@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-8">

    <h1 class="text-3xl font-bold mb-6">
        Add User
    </h1>

    @if($errors->any())

    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">

        <ul>

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif

    <form action="{{ route('users.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                Role
            </label>

            <select
                name="role_id"
                class="w-full border rounded px-4 py-2">

                <option value="">
                    Select Role
                </option>

                @foreach($roles as $role)

                <option
                    value="{{ $role->id }}"
                    {{ old('role_id') == $role->id ? 'selected' : '' }}>

                    {{ $role->name }}

                </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full border rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                Phone
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                class="w-full border rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                Password
            </label>

            <input
                type="password"
                name="password"
                class="w-full border rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                Confirm Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="w-full border rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                Profile Image
            </label>

            <input
                type="file"
                name="profile_image"
                class="w-full border rounded px-4 py-2">

        </div>

        <div class="mb-6">

            <label class="inline-flex items-center">

                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    checked>

                <span class="ml-2">

                    Active User

                </span>

            </label>

        </div>

        <div class="flex gap-4">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

                Save User

            </button>

            <a
                href="{{ route('users.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded">

                Cancel

            </a>

        </div>

    </form>

</div>

@endsection