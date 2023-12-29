<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userDashboard()
    {
        return view('admin.dashboard');
    }
    public function userViewInformation(Request $request)

    {
        $users = User::where('email', $request->email)->get();
        return view('admin.userInformation', ['users' => $users]);
    }
    public function deleteUserByUser(Request $request)
    {
        User::find($request->id)->delete();
        return redirect()->route('login');
    }
    public function update(Request $request)
    {
        // $users = DB::table('users')->where('id', $request->id)->first();
        $users =  User::find($request->id)->first();
        return view('admin.updateUserIndex', ['users' => $users]);
    }
    function storeUpdateUser(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:150|unique:users,email,' . $id,
            'password' => 'required|min:5|confirmed',
        ]);

        User::find($request->id)->update($request
            ->all());
        $request->session()->invalidate();
        return redirect()->route('login')->with('success', 'Your information has been updated successfully, Please login again ');
    }
}
