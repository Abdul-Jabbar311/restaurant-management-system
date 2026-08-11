@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow p-8">

        <h1 class="text-2xl font-bold mb-2">
            Edit Website Content
        </h1>

        <p class="text-gray-500 mb-6">
            Page: {{ $page }} |
            Section: {{ $key }}
        </p>

        <form
            method="POST"
            action="{{ route('editable-content.update', [$page, $key]) }}"
        >

            @csrf
            @method('PUT')

            <label class="block font-semibold mb-2">
                Content
            </label>

            <textarea
                name="content"
                rows="6"
                class="w-full border rounded-lg p-4 focus:ring-2 focus:ring-orange-500 focus:outline-none"
            >{{ old('content', $content->content) }}</textarea>

            @error('content')
                <p class="text-red-600 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror

            <div class="flex gap-3 mt-6">

                <button
                    type="submit"
                    class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg"
                >
                    Save Changes
                </button>

                <a
                    href="{{ route('home') }}"
                    class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-lg"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection