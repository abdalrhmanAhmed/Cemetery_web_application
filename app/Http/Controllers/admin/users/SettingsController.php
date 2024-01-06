<?php

namespace App\Http\Controllers\admin\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dark_mode_on(Request $request){
        $request->session()->put('dark_mode','on'); 
        return redirect()->back();
    }
    public function dark_mode_off(Request $request){
        $request->session()->forget('dark_mode'); 
        return redirect()->back();

    }

    public function changePassword(Request $request, $id)
    {
        try
        {
            if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
                // The passwords matches
                
                return redirect()->back()->with(['error' => __('Old Password Is Incorrect')]);
            }
    
            if(strcmp($request->get('old_password'), $request->get('password')) == 0){
                // Current password and new password same
                return redirect()->back()->with(["error"=>__("New Password cannot be same as your current password.")]);
            }
            $validatedData = $request->validate([
                'old_password' => 'required',
                'password' => 'required|confirmed',
            ]);
            //Change Password
            $user = User::where('id', $id)->first();
            $user->password = Hash::make($request->get('password'));
            $user->save();
            
            return redirect()->back()->with(["success"=>__("Password successfully changed!")]);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => __('There Is A Problem With The Server')]);
        }
  
    }
}
