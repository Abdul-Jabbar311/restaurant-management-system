@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="bg-white rounded-lg shadow p-6">

        <h1 class="text-3xl font-bold mb-6">
            Add Permission
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

        <form action="{{ route('permissions.store') }}" method="POST">

            @csrf

            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Permission Name

                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Example: Create Orders"
                    class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-200">

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-semibold">

                    Module

                </label>

                <select
                    name="module"
                    class="w-full border rounded-lg p-3">

                    <option value="">Select Module</option>

                    <option value="Users">Users</option>
                    <option value="Roles">Roles</option>
                    <option value="Categories">Categories</option>
                    <option value="Menu Items">Menu Items</option>
                    <option value="Customers">Customers</option>
                    <option value="Orders">Orders</option>
                    <option value="Reservations">Reservations</option>
                    <option value="Kitchen">Kitchen</option>
                    <option value="Inventory">Inventory</option>
                    <option value="Ingredients">Ingredients</option>
                    <option value="Suppliers">Suppliers</option>
                    <option value="Expenses">Expenses</option>
                    <option value="Attendance">Attendance</option>
                    <option value="Reports">Reports</option>
                    <option value="Settings">Settings</option>
                    <option value="Notifications">Notifications</option>

                </select>

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

                    Save

                </button>

                <a
                    href="{{ route('permissions.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection