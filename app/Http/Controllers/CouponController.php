<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display all coupons
     */
    public function index(Request $request)
    {
        $query = Coupon::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('code', 'like', '%' . $request->search . '%');

            });

        }

        $coupons = $query
            ->latest()
            ->paginate(10);

        return view('coupons.index', compact('coupons'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('coupons.create');
    }

    /**
     * Store coupon
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:coupons,code|max:255',
            'discount_percent' => 'required|integer|min:1|max:100',
            'expiry_date' => 'required|date',
            'is_active' => 'required|boolean',
        ]);

        Coupon::create($validated);

        return redirect()
            ->route('coupons.index')
            ->with('success', 'Coupon Created Successfully.');
    }

    /**
     * Show coupon details
     */
    public function show(Coupon $coupon)
    {
        return view('coupons.show', compact('coupon'));
    }

    /**
     * Show edit form
     */
    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    /**
     * Update coupon
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|max:255|unique:coupons,code,' . $coupon->id,
            'discount_percent' => 'required|integer|min:1|max:100',
            'expiry_date' => 'required|date',
            'is_active' => 'required|boolean',
        ]);

        $coupon->update($validated);

        return redirect()
            ->route('coupons.index')
            ->with('success', 'Coupon Updated Successfully.');
    }

    /**
     * Delete coupon
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()
            ->route('coupons.index')
            ->with('success', 'Coupon Deleted Successfully.');
    }
}