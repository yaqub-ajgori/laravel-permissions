<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionsResource;
use App\Http\Requests\PermissionsCreateRequest;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Permissions/Index', [
            'permissions' => PermissionsResource::collection(Permission::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Permissions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionsCreateRequest $request)
    {
        Permission::create($request->validated());
        return redirect()->route('permissions.index');
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
        $permission = Permission::findOrFail($id);
        return Inertia::render('Admin/Permissions/Edit', [
            'permission' => new PermissionsResource($permission),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionsCreateRequest $request, string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->validated());
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return back();
    }
}
