<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $query = Role::with('users');

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');

            });

        }

        $roles = $query
            ->latest()
            ->paginate(10);

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|max:255',
            'description' => 'nullable',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $role->permissions()->sync($request->permissions ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role Created Successfully.');
    }

    public function show(Role $role)
    {
        $role->load('permissions', 'users');

        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        $role->load('permissions');

        return view('roles.edit', compact(
            'role',
            'permissions'
        ));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable',
        ]);

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $role->permissions()->sync($request->permissions ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role Updated Successfully.');
    }

    public function destroy(Role $role)
    {
        $role->permissions()->detach();

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role Deleted Successfully.');
    }
}