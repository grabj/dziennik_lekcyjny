<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        if(Auth::user()->role =="0"){
            return view('admin/dashboard');
        }
        else if(Auth::user()->role=="1"){
            return view('lecturer/dashboard');
        }
        else if(Auth::user()->role=="2"){
            return view('student/dashboard');
        }
        else{
            return view('/dashboard')->with('message','Brak koniecznych uprawnień. Poczekaj aż administrator przypisze cię do roli.');
        }
    }
}
