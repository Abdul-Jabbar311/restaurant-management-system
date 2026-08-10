@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Restaurant Table Details</h2>

    <div class="card">

        <div class="card-body">

            <p><strong>Table Number:</strong> {{ $restaurantTable->table_number }}</p>

            <p><strong>Table Name:</strong> {{ $restaurantTable->table_name }}</p>

            <p><strong>Capacity:</strong> {{ $restaurantTable->capacity }}</p>

            <p><strong>Location:</strong> {{ $restaurantTable->location }}</p>

            <p><strong>Status:</strong> {{ $restaurantTable->status }}</p>

            @if($restaurantTable->qr_code)

                <img src="{{ asset($restaurantTable->qr_code) }}"
                     width="200">

            @endif

            <br><br>

            <a href="{{ route('restaurant-tables.index') }}"
               class="btn btn-primary">

                Back

            </a>

        </div>

    </div>

</div>

@endsection