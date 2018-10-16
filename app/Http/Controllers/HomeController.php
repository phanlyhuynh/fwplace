<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role != config('site.permission.trainee')) {
            return redirect()->route('calendar.workplace.list');
        }
        
        return redirect()->route('user.schedule', ['id' => Auth::user()->id]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
