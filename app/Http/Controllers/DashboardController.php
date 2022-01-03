<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    //

    public function index()
    {

        if (Auth::user()->hasRole('admin')) {

            return redirect('admin');

        } elseif (Auth::user()->hasRole('operator')) {
            
            return redirect('operator');
        }
    }
}


