<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function listUsers(){
        $data['getUsers'] = User::getUsers();
        return view('admin.users.list', $data);
    }
    public function addUser(){
        return view('admin.users.add');
    }
    public function storeUser(Request $request) : RedirectResponse
    {
        //dd($request->all());
        $user = new User();
        $request->merge(['user_id' => Auth::user()->id]);
        $user->create($request->all());
        return redirect('admin/users/add')->with('message','pomyślnie utworzono użytkownika');
    }
}
