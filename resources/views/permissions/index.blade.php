@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Permissions
    </h1>

    <a href="{{ route('permissions.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

        Add Permission

    </a>

</div>

@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-lg shadow overflow-x-auto">

<table class="min-w-full">

    <thead class="bg-gray-100">

        <tr>

            <th class="px-4 py-3 text-left">ID</th>

            <th class="px-4 py-3 text-left">Permission</th>

            <th class="px-4 py-3 text-left">Module</th>

            <th class="px-4 py-3 text-center">Actions</th>

        </tr>

    </thead>

    <tbody>

    @forelse($permissions as $permission)

        <tr class="border-t">

            <td class="px-4 py-3">

                {{ $permission->id }}

            </td>

            <td class="px-4 py-3">

                {{ $permission->name }}

            </td>

            <td class="px-4 py-3">

                {{ $permission->module }}

            </td>

            <td class="px-4 py-3 text-center">

                <a href="{{ route('permissions.show',$permission) }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">

                    View

                </a>

                <a href="{{ route('permissions.edit',$permission) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                    Edit

                </a>

                <form action="{{ route('permissions.destroy',$permission) }}"
                      method="POST"
                      class="inline">

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Delete this permission?')"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                        Delete

                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="4" class="text-center py-6">

                No Permissions Found

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

</div>

<div class="mt-6">

    {{ $permissions->links() }}

</div>

@endsection