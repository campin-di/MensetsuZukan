<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        return view('st/policy');
    }

    public function hrIndex()
    {
        return view('hr/policy');
    }
}
