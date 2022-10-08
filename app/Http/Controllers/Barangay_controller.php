<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Barangay_controller extends Controller
{
    public function admin_dashboard()
    {
        $user = User::find(auth()->user()->id);

        if ($user->user_type == 'Super_user') {
            return view('admin_dashboard', [
                'user' => $user,
            ]);
        } else {
            return view('admin_register_residents', [
                'user' => $user,
            ]);
        }
    }

    public function admin_user_type()
    {
        return view('admin_user_type');
    }

    public function admin_barangay_officials_registration()
    {
        $user = User::find(auth()->user()->id);
        $user_list = User::where('id', '!=', auth()->user()->id)->get();
        return view('admin_barangay_officials_registration', [
            'user_list' => $user_list,
            'user' => $user,
        ]);
    }

    public function admin_barangay_officials_registration_process(Request $request)
    {
        // return $request->input();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'string'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $new_user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'user_type' => $request->input('user_type'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob'),
        ]);

        $new_user->save();

        return redirect()->route('admin_barangay_officials_registration')->with('success', 'Success');
    }

    public function admin_register_residents()
    {
        $user = User::find(auth()->user()->id);
        return view('admin_register_residents',[
            'user' => $user,
        ]);
    }

    public function admin_registration_residents_generate_number_of_childrens(Request $request)
    {
        return view('admin_registration_residents_generate_number_of_childrens')
                ->with('number_of_childrens',$request->input('number_of_childrens'));
    }

    
}
