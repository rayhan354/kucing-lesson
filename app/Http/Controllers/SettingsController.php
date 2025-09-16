<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function profile()
    {
        // Your logic here (e.g., fetch user data)
        return view('settings.profile');
    }
}