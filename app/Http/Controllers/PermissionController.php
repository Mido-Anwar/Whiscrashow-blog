<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
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
        return Inertia::render('Admin/Permissions/Create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

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
        $Permission = Permission::find($id);
        return Inertia::render(
            'Admin/Permissions/Edit',
            [
                'permission' => $Permission,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Permission = Permission::find($id);
        $Permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);
        return Redirect::route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Permission = Permission::find($id);
        $Permission->delete();
        sleep(1);

        return redirect()->route('user.index')->with('message', 'Permission Delete Successfully');
    }
}
