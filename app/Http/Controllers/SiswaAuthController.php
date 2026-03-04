<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $identifier = trim($credentials['identifier']);

        $siswa = Siswa::where('nisn', $identifier)
            ->orWhere('email', $identifier)
            ->first();

        if (! $siswa || ! Hash::check($credentials['password'], $siswa->password)) {
            return back()->withInput()->withErrors([
                'identifier' => 'NISN/Email atau password siswa tidak valid.',
            ]);
        }

        $request->session()->put('siswa_auth', [
            'id' => $siswa->id,
            'nama' => $siswa->nama,
            'nisn' => $siswa->nisn,
            'email' => $siswa->email,
            'kelas' => $siswa->kelas,
        ]);

        return redirect()->route('siswa.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('siswa_auth');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.siswa');
    }
}
