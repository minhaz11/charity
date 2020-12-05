<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $option['menu']  = 'roles';
        $option['roles'] = Role::get(['id', 'name', 'display_name', 'description', 'created_at']);
        return view('admin.roles.list', $option);
    }

    public function create(Request $request)
    {
        $option['menu']  = 'roles';

        if ($request->isMethod('POST')) {

            $name        = $request->name;
            $displayName = $request->display_name;
            $description = $request->description;

            $this->validate($request, [
                'name'         => 'required|max:15|unique:roles,name',
                'display_name' => 'required'
            ]);

            $role = new Role();
            $role->name         = $name;
            $role->display_name = $displayName;
            $role->description  = $description;
            $role->save();

            if (isset($request->permissions)) {
                $permissions = $request->permissions;
                $role->syncPermissions($permissions);
            }

            return redirect('roles')->with('success', 'Role created successfully.');
        }

        $option['permissions'] = Permission::get(['id', 'name', 'display_name', 'group']);
        return view('admin.roles.create', $option);
    }

    public function edit(Request $request, $id)
    {
        $option['menu']  = 'roles';

        if ($request->isMethod('POST')) {

            $name        = $request->name;
            $displayName = $request->display_name;
            $description = $request->description;

            $this->validate($request, [
                'name'         => 'required|max:15|unique:roles,name,' . $id,
                'display_name' => 'required'
            ]);

            $role = Role::find($id);
            $role->name         = $name;
            $role->display_name = $displayName;
            $role->description  = $description;
            $role->save();

            $permissions = Permission::get(['id']);

            foreach ($permissions as $permission) {
                $role->revokePermissionTo($permission);
            }

            $updatedPermissions = $request->permissions;

            foreach ($updatedPermissions as $newPermission) {
                $permission = Permission::find($newPermission, ['id', 'guard_name']);
                $role->givePermissionTo($permission);
            }
            return redirect('roles')->with('success', 'Role and permissions updated successfully.');
        }

        $option['role'] = Role::find($id, ['id', 'name', 'display_name', 'description']);

        if (!empty($option['role'])) {
            $option['roles'] = Role::get(['id', 'name']);
            $option['permissions'] = Permission::get(['id', 'name', 'display_name', 'group']);
            return view('admin.roles.edit', $option);
        }
        return redirect()->back()->with('error', 'Role Not Found');
    }

    public function delete($id)
    {
        $role = Role::find($id, ['id']);

        if (!empty($role)) {
            try {
                DB::beginTransaction();

                if ($role->delete()) {
                    $permissions = $role->permissions()->get(['id']);
                    if (!$permissions->isEmpty()) {
                        $role->permissions()->detach($permissions);
                    }
                }
                DB::commit();
                return redirect('roles')->with('success', 'Role and permissions deleted successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            return redirect('roles')->with('error', 'Role not found.');
        }
    }
}
