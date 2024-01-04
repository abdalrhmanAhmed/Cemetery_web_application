<?php

namespace App\Http\Controllers\admin\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//custom Spatie\Permission
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('admin.users.show_users',compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }//end of index

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.Add_user',compact('roles'));
    }//end of create

    public function store(Request $request)
    {
        try
        {
            // return $request;
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
                'email' => 'required|email|unique:users,email',
                'roles' => 'required'
            ]);//end of validation
            
            $user = new User();
            $user->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $user->email = $request->email;
            $user->password = Hash::make('secret');
            $user->status = $request->status;
            $user->save();
            
            $user->assignRole($request->input('roles'));
            
            return redirect()->route('admin.users.index')
            ->with('success',__('Data has been saved successfully!'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }//end of store

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }//end of show

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        
        return view('admin.users.edit',compact('user','roles','userRole'));
    }//end of edit

    public function update(Request $request, $id)
    {
        try
        {
            $this->validate($request, [
                'name_ar' => 'required',
                'name_en' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'roles' => 'required'
            ]);
            
            $user = User::find($id);
            $user->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $user->email = $request->email;
            $user->status = $request->status;
            $user->save();
    
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            
            $user->assignRole($request->input('roles'));
            
            return redirect()->route('admin.users.index')
            ->with('success', __('Data has been Updated successfully!'));
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }//end of update

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')
        ->with('success', __('Data has been Deleted successfully!'));
    }//end of destroy
}
