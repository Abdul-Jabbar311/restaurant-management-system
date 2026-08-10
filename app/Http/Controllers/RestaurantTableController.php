<?php

namespace App\Http\Controllers;

use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RestaurantTableController extends Controller
{
    public function index(Request $request)
    {
        $query = RestaurantTable::query();

        if ($request->filled('search')) {
            $query->where('table_number', 'like', '%' . $request->search . '%')
                  ->orWhere('table_name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        $tables = $query
            ->latest()
            ->paginate(10);

        return view('restaurant_tables.index', compact('tables'));
    }

    public function create()
    {
        return view('restaurant_tables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_number' => 'required|unique:restaurant_tables,table_number',
            'table_name'   => 'required|string|max:255',
            'capacity'     => 'required|integer|min:1',
            'location'     => 'required|string|max:255',
        ]);

        $validated['status'] = 'Available';

        $table = RestaurantTable::create($validated);

        // Create QR Code folder if it doesn't exist
        $folder = public_path('qrcodes');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        try {

           $url = route('table.scan', $table->table_number);
            $fileName = 'table-' . $table->id . '.svg';

            $svg = QrCode::format('svg')
                ->size(300)
                ->generate($url);

            File::put(
                public_path('qrcodes/' . $fileName),
                $svg
            );

            // Save QR code path in database
            $table->update([
                'qr_code' => 'qrcodes/' . $fileName,
            ]);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect()
            ->route('restaurant-tables.index')
            ->with('success', 'Restaurant Table Created Successfully.');
    }
        public function show(RestaurantTable $restaurantTable)
    {
        return view('restaurant_tables.show', compact('restaurantTable'));
    }

    public function edit(RestaurantTable $restaurantTable)
    {
        return view('restaurant_tables.edit', compact('restaurantTable'));
    }

    public function update(Request $request, RestaurantTable $restaurantTable)
    {
        $validated = $request->validate([
            'table_number' => 'required|unique:restaurant_tables,table_number,' . $restaurantTable->id,
            'table_name'   => 'required|string|max:255',
            'capacity'     => 'required|integer|min:1',
            'location'     => 'required|string|max:255',
            'status'       => 'required',
        ]);

        $restaurantTable->update($validated);

        return redirect()
            ->route('restaurant-tables.index')
            ->with('success', 'Restaurant Table Updated Successfully.');
    }
        public function destroy(RestaurantTable $restaurantTable)
    {
        // Delete QR code file if it exists
        if ($restaurantTable->qr_code) {

            $qrPath = public_path($restaurantTable->qr_code);

            if (File::exists($qrPath)) {
                File::delete($qrPath);
            }
        }

        $restaurantTable->delete();

        return redirect()
            ->route('restaurant-tables.index')
            ->with('success', 'Restaurant Table Deleted Successfully.');
    }
    public function makeAvailable(RestaurantTable $restaurantTable)
{
    $restaurantTable->update([
        'status' => 'Available'
    ]);

    return back()->with('success', 'Table is now available.');
}
public function markAvailable(RestaurantTable $table)
{
    $table->update([
        'status' => 'Available'
    ]);

    return back()->with('success', 'Table is now available.');
}
}