<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
       $aboutData = [
        'app_name' => config('app.name', 'laravel'),
        'description' => 'Aplikasi evolusi perangkat lunak berbasis web menggunakan framework Laravel',
        'version' => '1.0.0',
       ];
       
       return view('about', compact('aboutData'));
    }
}
