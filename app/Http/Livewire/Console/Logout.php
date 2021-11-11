<?php

namespace App\Http\Livewire\Console;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('console.login');
    }

    public function render()
    {
        return view('livewire.console.logout');
    }
}
