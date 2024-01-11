<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function userInformationByAdmin()
    {
        $users = User::all();
        return view('admin.userInformation', ['users' => $users]);
    }
    public function deleteUserByAdmin(Request $request)
    {
        User::where('id', $request->id)->delete();
        return redirect()->route('userInformationByAdmin')->with('success', 'User has been deleted');
    }
    public function updateUserIndex(Request $request)
    {

        $users = User::where('id', $request->id)->first();

        return view('admin.updateUserIndex', ['users' => $users]);
    }

    function saveUpdate(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:150|unique:users,email,' . $request->id,
            'password' => 'required|min:5|confirmed',
        ]);

        User::find($request->id)->update($request->all());
        return redirect()->route('userInformationByAdmin')->withSuccess('User Information has been Updated successfully');
    }

    public function updateUserRoleIndex(Request $request)
    {

        $users = User::where('id', $request->id)->first();
        return view('admin.updateUserRoleIndex', ['users' => $users]);
    }

    function saveUpdateUserRole(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:150|unique:users,email,' . $id,
            'role' => 'required',
        ]);
        User::find($request->id)->update(['role' => $request->role]);
        return redirect()->route('userInformationByAdmin')->withSuccess('User role has been changed');
    }

    public function userEnableIndex(Request $request)
    {
        $users = User::where('id', $request->id)->first();
        return view('admin.userEnableIndex', ['users' => $users]);
    }

    function saveUserEnableStatus(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:150|unique:users,email,' . $id,
            'is_email_verified' => 'required',
        ]);
        User::find($request->id)->update(['is_email_verified' => $request->is_email_verified]);
        if ($request->is_email_verified == 0) {
            $status = 'Desable';
        } else {
            $status = 'Enable';
        }
        return redirect()->route('userInformationByAdmin')->withSuccess('User has been ' . $status);
    }
}
