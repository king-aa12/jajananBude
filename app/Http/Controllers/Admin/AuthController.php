<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if ($request->session()->has('admin_id')) {
            return redirect()->route('admin.produk.index');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $admin = Admin::where('username', $data['username'])->first();

        if (! $admin || ! Hash::check($data['password'], $admin->password)) {
            return back()
                ->withInput($request->only('username'))
                ->with('gagal', 'Username atau kata sandi salah. Silakan coba lagi.');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_id', $admin->id_admin);
        $request->session()->put('admin_nama', $admin->username);

        return redirect()->route('admin.produk.index');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id', 'admin_nama']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
