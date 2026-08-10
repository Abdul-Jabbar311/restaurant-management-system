@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-8">

    <h1 class="text-3xl font-bold mb-6">
        Edit User
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

    <form action="{{ route('users.update',$user) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                Role
            </label>

            <select
                name="role_id"
                class="w-full border rounded px-4 py-2">

                @foreach($roles as $role)

                <option
                    value="{{ $role->id }}"
                    {{ $user->role_id == $role->id ? 'selected' : '' }}>

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
                value="{{ old('name',$user->name) }}"
                class="w-full border rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email',$user->email) }}"
                class="w-full border rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                Phone
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone',$user->phone) }}"
                class="w-full border rounded px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                New Password
            </label>

            <input
                type="password"
                name="password"
                class="w-full border rounded px-4 py-2">

            <small class="text-gray-500">
                Leave blank if you don't want to change it.
            </small>

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">
                Profile Image
            </label>

            @if($user->profile_image)

                <img
                    src="{{ asset('storage/'.$user->profile_image) }}"
                    class="w-24 h-24 rounded-full object-cover mb-3">

            @endif

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
                    {{ $user->is_active ? 'checked' : '' }}>

                <span class="ml-2">

                    Active User

                </span>

            </label>

        </div>

        <div class="flex gap-4">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

                Update User

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