<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RolesController extends Controller implements HasMiddleware
{

    public static function middleware(): array
{
    return [
        new Middleware('permission:view roles', only:['index']),
        new Middleware('permission:edit roles', only:['edit']),
        new Middleware('permission:create roles', only:['create']),
        new Middleware('permission:destroy roles', only:['destroy']),
    ];
}

    public function index(){
        $roles = Role::orderBy('name' , 'ASC')->paginate(10);
        return view("roles.list",[
            'roles' => $roles
            ]);
    }

    public function create(){

        $permissions = Permission::orderBy('name','ASC')->get();
        return view("roles.create",[
                'permissions' => $permissions
            ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions|min:3'
            ]);

            if($validator->passes()) {

                $role = Role::create(['name' =>$request->name]);
                if(!empty($request->permission)) {
                    foreach($request->permission as $name) {
                        $role->givePermissionTo($name);
                    }
                }
                return redirect()->route("roles.index")->with( 'success' , 'Role added successfully.');
            }else {
                return redirect()->route("roles.create")->withInput()->withErrors($validator);
            }
    }


    public function edit($id){
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name','ASC')->get();
        return view("roles.edit",[
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions,
            'role' => $role,
            ]);
    }


    public function update(Request $request , $id){
        $role = Role::findOrFail($id);
    $validator = Validator::make($request->all(),[
        'name' => 'required|min:3|unique:roles,name,'.$id.',id'
        ]);

    if($validator->passes()) {

        $role->name = $request->name;
        $role->save();

        if(!empty($request->permission)) {
            $role->syncPermissions($request->permission);
        }else {
            $role->syncPermissions([]);
        }

        return redirect()->route("roles.index")->with('success' , 'Role Updated successfully.');
    }else {
        return redirect()->route("roles.edit",$id)->withInput()->withErrors($validator);
    }

    }

    public function destroy(Request $request){
        $id = $request->id;

        $role = Role::find($id);

        if($role == null) {
            session()->flash('error' , "Role not founded");
            return response()->json([
                'status' => false ]);
        }

        $role->delete();

        session()->flash('success' , "Role Deleted Successfully.");
            return response()->json([
                'status' => true ]);

    }


}
