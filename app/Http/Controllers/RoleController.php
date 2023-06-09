<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Spatie\Permission\Models\Role;
use App\Http\Resources\RoleResource;
use App\Http\Requests\RoleStoreRequest;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionsResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        Return Inertia::render('Admin/Roles/Index', [
            'roles' => RoleResource::collection(Role::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Roles/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request)
    {
        Role::create([
            'name' => $request->name,
        ]);

        return to_route('roles.index');
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
        $role = Role::findById($id);
        $role->load('permissions');
        return Inertia::render('Admin/Roles/Edit', [
            'role' => new RoleResource($role),
            'permissions' => PermissionsResource::collection(Permission::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleStoreRequest $request, string $id)
    {
        $role = Role::findById($id);
        $role->update([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->input('permissions.*.name'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();

        return back();
    }
}
