<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function redirectAfterLogin(){
    switch(Auth::user()->role){
        case 0:
            return redirect()->route('admin-dashboard');
        case 1:
            return redirect()->route('poverty-dashboard');
        case 3:
            return redirect()->route('facility.index');
        default:
            return abort(403);
}

    }
}
