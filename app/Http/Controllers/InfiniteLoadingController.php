<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfiniteLoadingController extends Controller
{
    public function index()
    {
        return view('loading');
    }
}
