@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Create Order
</h1>


@if ($errors->any())

    <div class="bg-red-100 text-red-700 p-4 rounded mb-6">

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


<div class="bg-white rounded-lg shadow p-6">

<form
    action="{{ route('orders.store') }}"
    method="POST"
>

@csrf


<!-- ================= CUSTOMER ================= -->

<div class="grid grid-cols-2 gap-6">

    <div>

        <label class="block mb-2 font-semibold">
            Customer
        </label>

        <select
            name="customer_id"
            class="w-full border rounded p-2"
            required
        >

            <option value="">
                Select Customer
            </option>

            @foreach($customers as $customer)

                <option
                    value="{{ $customer->id }}"
                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}
                >

                    {{ $customer->name }}

                </option>

            @endforeach

        </select>

    </div>


    <!-- ================= TABLE ================= -->

    <div>

        <label class="block mb-2 font-semibold">
            Restaurant Table
        </label>

        <select
            name="restaurant_table_id"
            class="w-full border rounded p-2"
            required
        >

            <option value="">
                Select Table
            </option>

            @foreach($tables as $table)

                <option
                    value="{{ $table->id }}"
                    {{ old('restaurant_table_id') == $table->id ? 'selected' : '' }}
                >

                    {{ $table->table_number }}

                </option>

            @endforeach

        </select>

    </div>

</div>



<!-- ================= ORDER ITEMS ================= -->

<div class="mt-10 border-t pt-8">

    <div class="flex justify-between items-center mb-5">

        <div>

            <h2 class="text-xl font-bold">
                Order Items
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                Select the food items and quantity ordered.
            </p>

        </div>


        <button
            type="button"
            onclick="addOrderItem()"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
        >

            + Add Item

        </button>

    </div>


    <div id="order-items-container">
    </div>


    <div
        id="no-items"
        class="border border-dashed border-gray-300 rounded-lg p-6 text-center text-gray-500"
    >

        No order items added yet.

        <br>

        Click
        <strong>+ Add Item</strong>
        to add food.

    </div>

</div>



<!-- ================= TOTAL ================= -->

<div class="mt-8 border-t pt-6">

    <div class="flex justify-end">

        <div class="w-80">

            <label class="block mb-2 font-semibold text-lg">
                Total Amount
            </label>

            <input
                type="number"
                step="0.01"
                name="total_amount"
                id="total_amount"
                value="{{ old('total_amount', 0) }}"
                class="w-full border rounded p-3 text-lg font-bold bg-gray-100"
                readonly
            >

        </div>

    </div>

</div>



<!-- ================= BUTTONS ================= -->

<div class="mt-8">

    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded"
    >

        Save Order

    </button>


    <a
        href="{{ route('orders.index') }}"
        class="ml-3 bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded"
    >

        Cancel

    </a>

</div>


</form>

</div>



<!-- ================= JAVASCRIPT ================= -->

<script>

let itemIndex = 0;


/*
|--------------------------------------------------------------------------
| Menu Items From Laravel
|--------------------------------------------------------------------------
*/

const menuItems = @json($menuItems);


/*
|--------------------------------------------------------------------------
| Add Order Item
|--------------------------------------------------------------------------
*/

function addOrderItem()
{
    const container =
        document.getElementById(
            'order-items-container'
        );

    const noItems =
        document.getElementById(
            'no-items'
        );


    noItems.style.display = 'none';


    const row =
        document.createElement('div');


    row.className =
        'order-item-row grid grid-cols-12 gap-4 items-end bg-gray-50 p-4 rounded-lg mb-4 border';


    let options = `
        <option value="">
            Select Food Item
        </option>
    `;


    menuItems.forEach(function(menuItem) {

        options += `
            <option
                value="${menuItem.id}"
                data-price="${menuItem.price}"
            >

                ${menuItem.name}
                - Rs. ${menuItem.price}

            </option>
        `;

    });


    row.innerHTML = `

        <!-- FOOD -->

        <div class="col-span-6">

            <label class="block mb-2 font-semibold">
                Food Item
            </label>

            <select
                name="items[${itemIndex}][menu_item_id]"
                class="menu-item-select w-full border rounded p-2"
                onchange="calculateTotal()"
                required
            >

                ${options}

            </select>

        </div>


        <!-- QUANTITY -->

        <div class="col-span-3">

            <label class="block mb-2 font-semibold">
                Quantity
            </label>

            <input
                type="number"
                name="items[${itemIndex}][quantity]"
                value="1"
                min="1"
                class="item-quantity w-full border rounded p-2"
                onchange="calculateTotal()"
                oninput="calculateTotal()"
                required
            >

        </div>


        <!-- REMOVE -->

        <div class="col-span-3">

            <button
                type="button"
                onclick="removeOrderItem(this)"
                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded"
            >

                Remove

            </button>

        </div>

    `;


    container.appendChild(row);

    itemIndex++;


    calculateTotal();
}



/*
|--------------------------------------------------------------------------
| Remove Order Item
|--------------------------------------------------------------------------
*/

function removeOrderItem(button)
{
    const row =
        button.closest(
            '.order-item-row'
        );


    row.remove();


    const container =
        document.getElementById(
            'order-items-container'
        );


    const noItems =
        document.getElementById(
            'no-items'
        );


    if (container.children.length === 0) {

        noItems.style.display = 'block';

    }


    calculateTotal();
}



/*
|--------------------------------------------------------------------------
| Calculate Total
|--------------------------------------------------------------------------
*/

function calculateTotal()
{
    let total = 0;


    const rows =
        document.querySelectorAll(
            '.order-item-row'
        );


    rows.forEach(function(row) {

        const select =
            row.querySelector(
                '.menu-item-select'
            );


        const quantityInput =
            row.querySelector(
                '.item-quantity'
            );


        if (!select || !quantityInput) {
            return;
        }


        const selectedOption =
            select.options[
                select.selectedIndex
            ];


        if (!selectedOption) {
            return;
        }


        const price =
            parseFloat(
                selectedOption.dataset.price
            ) || 0;


        const quantity =
            parseInt(
                quantityInput.value
            ) || 0;


        total +=
            price * quantity;

    });


    document.getElementById(
        'total_amount'
    ).value =
        total.toFixed(2);
}

</script>

@endsection