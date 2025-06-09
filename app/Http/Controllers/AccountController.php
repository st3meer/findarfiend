<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AccountController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'emoji_avatar' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^\X{1}$/u', $value)) {
                    $fail('Only one emoji is allowed.');
}
            }],
        ]);

        $user = auth()->user();
    
        $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'avatar' => $request->emoji_avatar, 
    ]);

        return back()->with('success', 'Account updated.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = auth()->user();
        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password changed.');
    }
}