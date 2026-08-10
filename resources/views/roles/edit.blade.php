@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-lg shadow p-6">

        <h1 class="text-3xl font-bold mb-6">
            Edit Role
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

        <form action="{{ route('roles.update',$role) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Role Name

                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name',$role->name) }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">

                    Description

                </label>

                <textarea
                    name="description"
                    rows="3"
                    class="w-full border rounded-lg p-3">{{ old('description',$role->description) }}</textarea>

            </div>

            <div class="mb-6">

                <h2 class="text-xl font-semibold mb-4">

                    Assign Permissions

                </h2>

                <div class="grid grid-cols-2 gap-4">

                    @foreach($permissions as $permission)

                        <label class="flex items-center space-x-2 border rounded-lg p-3 hover:bg-gray-50">

                            <input
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission->id }}"
                                {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>

                            <span>

                                {{ $permission->name }}

                                <small class="text-gray-500">

                                    ({{ $permission->module }})

                                </small>

                            </span>

                        </label>

                    @endforeach

                </div>

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

                    Update Role

                </button>

                <a href="{{ route('roles.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection