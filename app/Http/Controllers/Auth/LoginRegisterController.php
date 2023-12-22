<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Jobs\NewUserWelcomeMail;

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function userInformation()
    {
        $users = DB::table('users')->get();
        return view('Auth.userInformation', ['users' => $users]);
    }
    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('user.register');
    }
    public function login()
    {
        return view('user.login');
    }

    public function AuthDashboard()
    {
        return view('Auth.dashboard');
    }
    public function dashboard()
    {
        return view('user.dashboard');
    }
    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:150|unique:users',
            'password' => 'required|min:5|confirmed',


        ]);

        User::create([
            'name' => $request->name,
            'email' => ($request->email),
            'password' => Hash::make($request->password),
            'Roll_id' => 0
        ]);

        $testMailData = [
            'title' => ('Hello ' .  $request->name),
            'body' => ('This is Mail From Profilics Pvt. Limited'),
            'useremail' => ('Your Email: ' .  $request->email),
            'userpassword' => ('and your Password : ' .  $request->password),
            'thanksMessage' => ('Thank You for registring our website'),
            'instruction' => ('We are remember you, Hope you will remind your password because we can not provide again.')
        ];
        dispatch(new NewUserWelcomeMail($request->email, $testMailData));
        $request->session()->regenerate();
        return redirect()->route('login')->withSuccess('Your registration has been submitted successfully Please Check Your Gmail');
    }
    function loginUserAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:150|',
            'password' => 'required|min:5|',

        ]);
        if (Auth::user()->Roll_id == '1') //1 = Admin Login
        {
            return redirect()->route('')->withSuccess('Welcome to your dashboard');
        } elseif (Auth::user()->Roll_id == '0') // Normal or Default User Login
        {
            return redirect()->route('dashboard')->withSuccess('Logged in successfully');
        }
        return redirect()->route('login')->withErrors('Please register first');
    }

    public function userViewInformation(Request $request)

    {
        // dd($request->email);
        $users = DB::table('users')->where('email', $request->email)->get();
        return view('user.userInformation', ['users' => $users]);
    }

    public function deleteUserByAdmin(Request $request)
    {
        DB::table('users')->where('id', $request
            ->id)->delete();
        return redirect()->route('userInformation')->withSuccess('User has been deleted');
    }

    public function deleteUserByUser(Request $request)
    {
        DB::table('users')->where('id', $request
            ->id)->delete();
        return redirect()->route('login');
    }

    public function logout()
    {
        return redirect()->route('login')->withSuccess('You have Logout Successfully');
    }
}
