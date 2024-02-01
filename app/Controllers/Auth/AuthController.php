<?php

namespace App\Controllers\Auth;
use CodeIgniter\Controller;

class AuthController extends Controller
{

    public function index()
    {
        return view('Auth/login');
    }
}
