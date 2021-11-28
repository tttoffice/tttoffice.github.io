<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        // App::before(function($request)
        // {
        //     // If user is logged in
        //     if (Auth::check())
        //     {
        //         // Get the user specific language
        //         $lang = Auth::user()->language;

        //         // Set the language
        //         App::setLocale($lang);
        //     }
        // });
       // dd(auth::user()->hasRole('super_admin'));
       if(auth::user()->hasRole('super_admin')){
            return view('dashboard.index');
       }elseif(auth::user()->hasRole('editor')){
            return redirect()->route('dashboard.allcalls') ;
       }else{
            return redirect()->route('dashboard.tickets.index');
       }

    }
}
