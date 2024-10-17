<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate all the Attributes
        $userAttributes = $request->validate([
                'name' => ['required'],
                'email' => ['required' , 'email', 'unique:users,email'],
                'password' => ['required', 'confirmed', Password::min(5)],
        ]);

        $employerAttributes = $request->validate([
            'employer' => ['required'],
            'logo' => ['required', File::types(['png', 'jpg', 'webp'])],
          ]);
               // Create the user
          $user = User::create($userAttributes);
                // Store the logo
          $logoPath = $request->logo->store('logos');
                // Create a new Employer
          $user->employer()->create([
            'name' => $employerAttributes['employer'],
            'logo' => $logoPath,
          ]);

          Auth::login($user);
                     // WELCOME TO HOMEPAGE
              return redirect('/');
    }

}
