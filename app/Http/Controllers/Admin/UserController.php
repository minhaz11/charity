<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        $option['menu']  = 'users';
        $option['users'] = User::with('roles:name')->orderBy('id', 'desc')->get(['id', 'first_name', 'last_name', 'email', 'phone', 'user_type', 'photo', 'status']);

        return view('admin.users.list', $option);
    }

    /**
     * Method create
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function create(Request $request)
    {
        $option['menu']  = 'users';

        if ($request->isMethod('POST')) {

            $this->validate($request, [
                'first_name'            => 'required|max:255',
                'last_name'             => 'required|max:255',
                'email'                 => 'required|email|unique:users,email',
                'phone'                 => 'unique:users',
                'role'                  => 'required',
                'password'              => 'required|confirmed|min:8',
                'password_confirmation' => 'required',
                'photo'                 => 'mimes:jpg,png,jpeg,gif,bmp|nullable'
            ]);

            try {
                DB::beginTransaction();

                $user = new User();
                $user->first_name = $request->first_name;
                $user->last_name  = $request->last_name;
                $user->email      = $request->email;
                $user->phone      = $request->phone;
                $user->user_type  = Role::find($request->role, ['name'])->name;
                $user->password   = Hash::make($request->password);
                $user->status     = 'active';
                if (isset($request->photo)) {
                    $user->photo  = uploadImage($request->photo, 'public/admin/images/uploads/users');
                }

                if ($user->save()) {
                    $role = Role::find($request->role, ['id']);
                    if (!empty($role)) {
                        $user->assignRole($request->role);
                        DB::commit();
                        return redirect('users')->with('success', 'User created successfully.');
                    }
                    return redirect('users')->with('error', 'Role not found.');
                }
                return redirect('users')->with('error', 'Something went wrong!.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect('users/create')->with('error', $e->getMessage());
            }
        }

        $option['roles'] = Role::get(['id', 'name']);
        return view('admin.users.create', $option);
    }

    /**
     * Method edit
     *
     * @param Request $request [explicite description]
     * @param $id $id [User ID]
     *
     * @return void
     */
    public function edit(Request $request, $id)
    {
        $option['menu'] = 'users';

        if ($request->isMethod('POST')) {

            $this->validate($request, [
                'first_name'            => 'required|max:255',
                'last_name'             => 'required|max:255',
                'email'                 => 'required|email|unique:users,email,' . $id,
                'role'                  => 'required',
                'password'              => 'nullable|confirmed|min:8',
                'password_confirmation' => 'nullable',
                'status'                => 'required',
                'photo'                 => 'mimes:jpg,png,jpeg,gif,bmp|nullable'
            ]);

            try {
                DB::beginTransaction();

                $user = User::find($id);
                $user->first_name = $request->first_name;
                $user->last_name  = $request->last_name;
                $user->email      = $request->email;
                $user->phone      = $request->phone;
                $user->user_type  = Role::find($request->role, ['name'])->name;
                $user->status     = strtolower($request->status) == 'active' ? 'active' : 'inactive';
                if (isset($request->password)) {
                    $user->password   = Hash::make($request->password);
                }
                if (isset($request->photo)) {
                    $user->photo  = uploadImage($request->photo, 'public/admin/images/uploads/users/', null, $user->photo);
                }

                if ($user->save()) {
                    $role = Role::find($request->role, ['id']);
                    if (!empty($role)) {
                        $user->assignRole($request->role);
                        DB::commit();
                        return redirect('users')->with('success', 'User updated successfully.');
                    }
                    return redirect('users')->with('error', 'Role not found.');
                }
                return redirect('users')->with('error', 'Something went wrong!.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect('users/create')->with('error', $e->getMessage());
            }
        }

        $option['roles'] = Role::get(['id', 'name']);
        $option['user']  = User::with(['roles:id,name'])->find($id, ['id', 'first_name', 'last_name', 'email', 'phone', 'photo', 'status']);
        if (empty($option['user'])) {
            return redirect('users')->with('error', 'User not found.');
        }
        return view('admin.users.edit', $option);
    }
    
    /**
     * Method delete
     *
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function delete($id)
    {
        $user = User::find($id); // , ['id']

        if (!empty($user)) {
            try {
                DB::beginTransaction();

                if ($user->delete()) {
                    $imagePath = 'public/admin/images/uploads/users/' . $user->photo;
                    if (file_exists($imagePath)) {
                        @unlink($imagePath);
                    }
                }
                DB::commit();
                return redirect('users')->with('success', 'User deleted successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            return redirect('users')->with('error', 'User not found.');
        }
    }
}
