<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Role/Create', [
            'permissions' => PermissionResource::collection(Permission::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role =   Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);
        $role->givePermissionTo($request->permission_id);
        return Redirect::route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        return Inertia::render('Admin/Role/Edit', [
            'role' => $role,
            'permissions' => PermissionResource::collection(Permission::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);

        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);
        $role->syncPermissions($request->permission_id);

        return Redirect::route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        sleep(1);

        return redirect()->route('user.index')->with('message', 'Role Delete Successfully');
    }
}
