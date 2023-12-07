<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $setting = Setting::all();

        return view('layouts.front', compact('setting'));
    }
}
