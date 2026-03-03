<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InternalAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $admin = User::where('email', $credentials['email'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            $request->session()->put('internal_auth', [
                'tipe' => 'admin',
                'id' => $admin->id,
                'nama' => $admin->name,
                'email' => $admin->email,
            ]);

            return redirect()->route('admin.dashboard');
        }

        $petugas = Petugas::where('email', $credentials['email'])->first();
        if ($petugas && Hash::check($credentials['password'], $petugas->password)) {
            $request->session()->put('internal_auth', [
                'tipe' => 'petugas',
                'id' => $petugas->id,
                'nama' => $petugas->nama,
                'email' => $petugas->email,
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()->withInput()->withErrors([
            'email' => 'Email atau password internal tidak valid.',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('internal_auth');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.internal');
    }
}
