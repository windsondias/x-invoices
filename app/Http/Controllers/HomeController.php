<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        return Redirect::route('invoices.index');
//        return inertia('Home');
    }
}
