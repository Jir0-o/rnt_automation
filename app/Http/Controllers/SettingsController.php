<?php

namespace App\Http\Controllers;

use App\Models\ApplicableSession;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SettingsController extends Controller
{
    public function index()
    {
        // $roles = Role::with('permissions')->latest()->get();
        // $permissions = Permission::all();
        // $users = User::with('roles')->latest()->get();

        
        return view('backend.pages.settings');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => "required|unique:roles,name"
            ]);
    
            $role = Role::create(['name' => $request->name , 'guard_name'=>'web']);

            $permissions = Permission::whereIn('id', $request->permission)->get();
            
            $role->syncPermissions($permissions);

            return response()->json(['message' => 'Role created successfully!', 'data' => $role]);

            
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function show()
    {
        try {
            $setting = Setting::with([
                'applicableSession',
            ])->latest()->get();

            if(!$setting){
                return response()->json([
                    'status' => true,
                    'message' => 'No setting found',
                    'data' => $setting
                ], 200);
            }

            return response()->json([
                'status' => true,
                'message' => 'Setting fetched successfully',
                'data' => $setting
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch setting',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}