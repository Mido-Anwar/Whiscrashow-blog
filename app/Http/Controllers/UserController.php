<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Resources\RoleResource;
use Inertia\Response;
use Spatie\Permission\Models\Role;
use App\Http\Resources\PermissionResource;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Index', [
            'users' => UserResource::collection(User::all()),
            'roles' => RoleResource::collection(Role::all()),
            'permissions' => PermissionResource::collection(Permission::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/CreateNewUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('User');
        return redirect()->route('user.index')->with('message', 'user added Successfully');
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
        $user = User::find($id);
        return Inertia::render('Admin/EditUser', [
            'user' => $user,
            'roles' => RoleResource::collection(Role::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles($request->role_id);
        return Redirect::route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        sleep(1);
        return redirect()->route('user.index')->with('message', 'user Delete Successfully');
    }
}
