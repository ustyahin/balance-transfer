<?php

namespace App\Http\Controllers;

use App\User;

class IndexController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('index', ['users' => $users]);
    }
}
