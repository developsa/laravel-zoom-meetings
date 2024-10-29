<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'avaliable_password' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
        $user = auth()->user();
        if (!Hash::check($request->avaliable_password, $user->password)) {
            return back()->withErrors(['avaliable_password' => 'Current password is incorrect']);
        }
        $user->password = Hash::make($request->password);
        return redirect()->back()->with('success', 'Your Password has been successfully updated.');
    }
}
