<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function redirectAfterLogin(){
        switch(Auth::user()->role){
            case 0:
                dd(Auth::user()->name);
                return redirect(route('admin-dashboard'));
                break;
            case 1:
                return redirect(route('poverty-dashboard'));
                break;
            case 3:
                return redirect(route('facility.index'));
                break;
            default:
                return redirect(403);
                break;
        }
    }
}
