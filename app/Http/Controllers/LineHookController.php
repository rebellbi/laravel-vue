<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineHookController extends Controller
{
    public function webhook(Request $request)
    {
        return response('hi',200);
    }
}
