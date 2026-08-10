@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Attendance
    </h1>

    <a href="{{ route('attendances.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
        Add Attendance
    </a>

</div>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-4 rounded mb-4">
    {{ session('success') }}
</div>

@endif

<div class="bg-white rounded-lg shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-3 text-left">Employee</th>
                <th class="p-3 text-left">Date</th>
                <th class="p-3 text-left">Check In</th>
                <th class="p-3 text-left">Check Out</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-center">Action</th>

            </tr>

        </thead>

        <tbody>

        @forelse($attendances as $attendance)

            <tr class="border-t">

                <td class="p-3">
                    {{ $attendance->user->name }}
                </td>

                <td class="p-3">
                    {{ $attendance->attendance_date }}
                </td>

                <td class="p-3">
                    {{ $attendance->check_in }}
                </td>

                <td class="p-3">
                    {{ $attendance->check_out ?? '-' }}
                </td>

                <td class="p-3">
                    {{ $attendance->status }}
                </td>

                <td class="p-3">

                    <div class="flex justify-center gap-2">

                        <a href="{{ route('attendances.edit',$attendance) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        <form action="{{ route('attendances.destroy',$attendance) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Delete Attendance?')"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                Delete
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6" class="text-center p-5">
                    No Attendance Records Found.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection