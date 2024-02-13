<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $empresa = empresa();
        $variables = variables();

        return view('security.home', compact('user','empresa','variables'));
    }
}
