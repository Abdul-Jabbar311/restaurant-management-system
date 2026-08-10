<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $query = Setting::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('restaurant_name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');

            });

        }

        $settings = $query
            ->latest()
            ->paginate(10);

        return view('settings.index', compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_name' => 'required|max:255',
            'phone' => 'required|max:20',
            'email' => 'required|email',
            'address' => 'required',
            'tax_percentage' => 'required|numeric|min:0',
            'currency' => 'required|max:20',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {

            $validated['logo'] = $request->file('logo')
                ->store('logos', 'public');

        }

        Setting::create($validated);

        return redirect()
            ->route('settings.index')
            ->with('success', 'Settings Created Successfully.');
    }

    public function show(Setting $setting)
    {
        return view('settings.show', compact('setting'));
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'restaurant_name' => 'required|max:255',
            'phone' => 'required|max:20',
            'email' => 'required|email',
            'address' => 'required',
            'tax_percentage' => 'required|numeric|min:0',
            'currency' => 'required|max:20',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {

            if ($setting->logo) {

                Storage::disk('public')->delete($setting->logo);

            }

            $validated['logo'] = $request->file('logo')
                ->store('logos', 'public');

        }

        $setting->update($validated);

        return redirect()
            ->route('settings.index')
            ->with('success', 'Settings Updated Successfully.');
    }

    public function destroy(Setting $setting)
    {
        if ($setting->logo) {

            Storage::disk('public')->delete($setting->logo);

        }

        $setting->delete();

        return redirect()
            ->route('settings.index')
            ->with('success', 'Settings Deleted Successfully.');
    }
}