<?php

namespace App\Livewire\Actions;

use App\Models\Registro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutAdmin
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke()
    {
        Registro::registrar_accion(null, null, 2);

        Auth::guard('admin')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
