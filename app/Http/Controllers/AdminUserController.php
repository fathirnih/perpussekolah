<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        $daftarAdmin = User::latest()->get();

        return view('admin.user.index', compact('daftarAdmin'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $data['password'] = $data['password'] ?? 'password';

        User::create($data);

        return redirect()->route('admin.user.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit(User $admin_user)
    {
        return view('admin.user.edit', ['adminUser' => $admin_user]);
    }

    public function update(Request $request, User $admin_user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($admin_user->id)],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $admin_user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy(User $admin_user)
    {
        $admin_user->delete();

        return redirect()->route('admin.user.index')->with('success', 'Admin berhasil dihapus.');
    }
}
