<?php

namespace App\Http\Controllers;

use App\Jobs\NewUserWelcomeMail;
use App\Jobs\RecieveMailFromUser;
use App\Mail\RecieveMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class AuthController extends Controller
{
    function index()
    {
        return view('home');
    }

    function register()
    {

        return view('register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:150|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);

        $recieveMailData = User::create([
            'name' => $request->name,
            'email' => ($request->email),
            'password' => Hash::make($request->password),
        ]);
        $testMailData = [
            'title' => ($request->name),
            'body' => ('This is Mail From Profilics Pvt. Limited'),
            'useremail' => ('Your Email: ' .  $request->email),
            'userpassword' => ('and your Password : ' .  $request->password),
            'thanksMessage' => ('Thank You for registring our website'),
            'instruction' => ('We are remember you, Hope you will remind your password because we can not provide again.')
        ];
        Mail::to($request->email)->send(new SendMail(
            $testMailData
        ));
        Mail::to($request->email)->send(new RecieveMail($recieveMailData));
        // dispatch(new RecieveMailFromUser($request->email, $recieveMailData));
        // dispatch(new NewUserWelcomeMail($request->email, $testMailData));
        return redirect()->route('login')->withSuccess('Your registration has been submitted successfully Please Check Your Gmail');
    }
    function login()
    {
        if (Auth::user()) {
            return redirect($this->redirectDash());
        }
        return view('login');
    }

    public function loginRequest(Request $request)
    {
        $request->validate([
            'email' => 'string|required|email',
            'password' => 'string|required'
        ]);
        $userCredential = $request->only('email', 'password');

        if (Auth::attempt($userCredential)) {
            if (Auth::user() && Auth::user()->role == 1) {
                return redirect()->route('adminDashboard')->with('success', 'Welcome Admin');
            } else {
                return redirect()->route('userDashboard')->with('success', 'Welcome You are Logged In');
            }
        } else {
            return back()->with('error', 'Username & Password is incorrect');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('error', 'You have logout successfully');
    }
    function redirectDash()
    {
        if (Auth::user() && Auth::user()->role == 1) {
            $redirect =  route('adminDashboard');
        } else {
            $redirect = route('userDashboard');
        }
        return $redirect;
    }
}
