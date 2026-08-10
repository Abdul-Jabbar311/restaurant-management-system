<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Customer;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;


class ReservationController extends Controller
{
    /**
     * Display all reservations
     */
    public function index(Request $request)
    {
        $query = Reservation::with(['customer', 'table']);

        if ($request->filled('search')) {

            $query->whereHas('customer', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%');

            })->orWhereHas('table', function ($q) use ($request) {

                $q->where('table_number', 'like', '%' . $request->search . '%');

            });

        }

        $reservations = $query
            ->latest()
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $customers = Customer::all();
        $tables = RestaurantTable::all();

        return view('reservations.create', compact('customers', 'tables'));
    }

    /**
     * Store reservation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'restaurant_table_id' => 'required|exists:restaurant_tables,id',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'number_of_guests' => 'required|integer|min:1',
            'special_request' => 'nullable|string',
        ]);

        Reservation::create([
            'customer_id' => $validated['customer_id'],
            'restaurant_table_id' => $validated['restaurant_table_id'],
            'reservation_date' => $validated['reservation_date'],
            'reservation_time' => $validated['reservation_time'],
            'number_of_guests' => $validated['number_of_guests'],
            'status' => 'Pending',
            'special_request' => $validated['special_request'] ?? null,
        ]);

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reservation Created Successfully.');
    }

    /**
     * Show reservation
     */
    public function show(Reservation $reservation)
{
    $reservation->load([
        'customer',
        'restaurantTable'
    ]);

    return view('reservations.show', compact('reservation'));
}
    /**
     * Show edit form
     */
    public function edit(Reservation $reservation)
    {
        $customers = Customer::all();
        $tables = RestaurantTable::all();

        return view('reservations.edit', compact(
            'reservation',
            'customers',
            'tables'
        ));
    }

    /**
     * Update reservation
     */
   public function update(Request $request, Reservation $reservation)
{
    $validated = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'restaurant_table_id' => 'required|exists:restaurant_tables,id',
        'reservation_date' => 'required|date',
        'reservation_time' => 'required',
        'number_of_guests' => 'required|integer|min:1',
        'special_request' => 'nullable|string',
    ]);

    $reservation->update([
        'customer_id' => $validated['customer_id'],
        'restaurant_table_id' => $validated['restaurant_table_id'],
        'reservation_date' => $validated['reservation_date'],
        'reservation_time' => $validated['reservation_time'],
        'number_of_guests' => $validated['number_of_guests'],
        'special_request' => $validated['special_request'] ?? null,
    ]);

    return redirect()
        ->route('reservations.index')
        ->with('success', 'Reservation Updated Successfully.');
}

    /**
     * Delete reservation
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reservation Deleted Successfully.');
    }
}