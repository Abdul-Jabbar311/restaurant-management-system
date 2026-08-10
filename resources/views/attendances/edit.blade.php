@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Edit Attendance
</h1>

@if($errors->any())

<div class="bg-red-100 text-red-700 p-4 rounded mb-4">

    <ul>

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="bg-white rounded-lg shadow p-6">

<form action="{{ route('attendances.update',$attendance) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="grid grid-cols-2 gap-6">

        <div>

            <label class="block mb-2 font-semibold">
                Employee
            </label>

            <select
                name="user_id"
                class="w-full border rounded p-2">

                @foreach($users as $user)

                    <option
                        value="{{ $user->id }}"
                        {{ $attendance->user_id == $user->id ? 'selected' : '' }}>

                        {{ $user->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Attendance Date
            </label>

            <input
                type="date"
                name="attendance_date"
                class="w-full border rounded p-2"
                value="{{ $attendance->attendance_date }}">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Check In
            </label>

            <input
                type="time"
                name="check_in"
                class="w-full border rounded p-2"
                value="{{ $attendance->check_in }}">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Check Out
            </label>

            <input
                type="time"
                name="check_out"
                class="w-full border rounded p-2"
                value="{{ $attendance->check_out }}">

        </div>

        <div>

            <label class="block mb-2 font-semibold">
                Status
            </label>

            <select
                name="status"
                class="w-full border rounded p-2">

                <option value="Present" {{ $attendance->status=='Present'?'selected':'' }}>Present</option>

                <option value="Absent" {{ $attendance->status=='Absent'?'selected':'' }}>Absent</option>

                <option value="Late" {{ $attendance->status=='Late'?'selected':'' }}>Late</option>

                <option value="Leave" {{ $attendance->status=='Leave'?'selected':'' }}>Leave</option>

            </select>

        </div>

    </div>

    <div class="mt-6">

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

            Update Attendance

        </button>

        <a
            href="{{ route('attendances.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded ml-2">

            Cancel

        </a>

    </div>

</form>

</div>

@endsection