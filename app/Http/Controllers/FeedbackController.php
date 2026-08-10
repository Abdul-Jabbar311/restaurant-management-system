<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Customer;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display all feedback
     */
    public function index(Request $request)
    {
        $query = Feedback::with('customer');

        if ($request->filled('search')) {

            $query->whereHas('customer', function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%');

            });

        }

        $feedback = $query
            ->latest()
            ->paginate(10);

        return view('feedback.index', compact('feedback'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        return view('feedback.create', compact('customers'));
    }

    /**
     * Store feedback
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'rating'      => 'required|integer|min:1|max:5',
            'comment'     => 'nullable',
        ]);

        Feedback::create($validated);

        return redirect()
            ->route('feedback.index')
            ->with('success', 'Feedback Added Successfully.');
    }

    /**
     * Show feedback details
     */
    public function show(Feedback $feedback)
    {
        return view('feedback.show', compact('feedback'));
    }

    /**
     * Show edit form
     */
    public function edit(Feedback $feedback)
    {
        $customers = Customer::orderBy('name')->get();

        return view('feedback.edit', compact(
            'feedback',
            'customers'
        ));
    }

    /**
     * Update feedback
     */
    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'rating'      => 'required|integer|min:1|max:5',
            'comment'     => 'nullable',
        ]);

        $feedback->update($validated);

        return redirect()
            ->route('feedback.index')
            ->with('success', 'Feedback Updated Successfully.');
    }

    /**
     * Delete feedback
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()
            ->route('feedback.index')
            ->with('success', 'Feedback Deleted Successfully.');
    }
}