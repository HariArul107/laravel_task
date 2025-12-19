<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\loginuser;
use Illuminate\Support\Facades\Session;

class authentication extends Controller
{
    public function login()
    {
        if (Session::has('user_name')) {
            return redirect('/home');
        }
        return view('log-in');
    }

    public function register()
    {
        return view('register-form');
    }


    public function storeData(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'Fname'  => ['required', 'regex:/^[a-zA-Z\-\' ]*$/'],
            'Lname'  => ['required', 'regex:/^[a-zA-Z\-\' ]*$/'],
            'email'  => 'required|email|unique:projectusers,email',
            'phone'  => ['required', 'regex:/^[0-9]{10}$/'],
            'dob'    => 'required|date',
            'gender' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        // Here you can handle the validated data, e.g., save it to the database
        loginuser::create([
            'Fname'    => $validated['Fname'],
            'Lname'    => $validated['Lname'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'],
            'dob'      => $validated['dob'],
            'gender'   => $validated['gender'],
            'password' => bcrypt($validated['password']), // Hash the password
        ]);
        // For demonstration, we'll just return a success message
        return redirect('/')->with('success', 'Registration successful! Please log in.');
    }


    public function loginhome(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // Attempt to find the user by email
        $user = loginuser::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // Authentication passed
            $request->session()->put('user_name', $user->Fname);
            $request->session()->put('user_id', $user->id);
            return redirect('/home');
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }


    public function home()
    {
        if (!Session::has('user_name')) {
            return redirect('/');
        }
        return view('home');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
