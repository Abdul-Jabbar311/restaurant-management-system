@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

    <h2 class="text-2xl font-bold mb-6">
        Coupon Details
    </h2>

    <table class="table-auto w-full">

        <tr>
            <td class="font-bold py-2">Code</td>
            <td>{{ $coupon->code }}</td>
        </tr>

        <tr>
            <td class="font-bold py-2">Discount</td>
            <td>{{ $coupon->discount_percent }}%</td>
        </tr>

        <tr>
            <td class="font-bold py-2">Expiry Date</td>
            <td>{{ $coupon->expiry_date->format('d M Y') }}</td>
        </tr>

        <tr>
            <td class="font-bold py-2">Status</td>
            <td>
                {{ $coupon->is_active ? 'Active' : 'Inactive' }}
            </td>
        </tr>

    </table>

    <a href="{{ route('coupons.index') }}"
       class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded">
        Back
    </a>

</div>

@endsection