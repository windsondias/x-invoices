<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        return Redirect::route('login');
//        return inertia('Home');
    }

    public function home()
    {
        return Redirect::route('invoices.index');
//        return inertia('Home');
    }
}
