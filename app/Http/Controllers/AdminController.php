<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aministrador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo_admin' => 'required|email',
            'pwd' => 'required',
        ]);

        $admin = Aministrador::where('correo_admin', $request->correo_admin)->first();

        if ($admin && Hash::check($request->pwd, $admin->pwd) && $admin->activo) {
            Auth::login($admin);
            return redirect()->route('admin.dashboard');
        }
        
        return back()->withErrors([
            'correo_admin' => 'Credenciales inválidas',
            'pwd' => 'Credenciales inválidas'
        ]);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
