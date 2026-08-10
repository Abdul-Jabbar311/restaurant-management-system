<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('role');

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%');

            });

        }

        if ($request->filled('role')) {

            $query->whereHas('role', function ($q) use ($request) {

                $q->where('name', $request->role);

            });

        }

        if ($request->filled('status')) {

            $query->where('is_active', $request->status);

        }

        $users = $query->latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|max:20',
            'password' => 'required|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'nullable'
        ]);

        $image = null;

        if ($request->hasFile('profile_image')) {

            $image = $request->file('profile_image')
                ->store('users', 'public');

        }

        User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'profile_image' => $image,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|max:20',
            'password' => 'nullable|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {

            if ($user->profile_image) {

                Storage::disk('public')->delete($user->profile_image);

            }

            $user->profile_image = $request->file('profile_image')
                ->store('users', 'public');
        }

        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->is_active = $request->has('is_active');

        if ($request->filled('password')) {

            $user->password = Hash::make($request->password);

        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {

            return back()->with(
                'error',
                'You cannot delete your own account.'
            );
        }

        if ($user->profile_image) {

            Storage::disk('public')->delete($user->profile_image);

        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}