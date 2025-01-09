<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([

        ]);

        //dd($request->all());
        $user = new User();
        $request->merge(['user_id' => Auth::user()->id]);
        $user->create($request->all());
        return redirect('admin/users/add')->with('message','pomyślnie utworzono użytkownika');
    }
    public function editUser($id){
        $data['getUsers']= User::getSingle($id);
        if(!empty($data['getUsers'])){
            return view('admin.users.edit', $data);
        }else{
            abort(404);
        }
    }
    public function updateUser($id, Request $request): RedirectResponse
    {
        $user = User::getSingle($id);
        $user->name=trim($request->name);
        $user->surname=trim($request->surname);
        $user->email=trim($request->email);
        $user->role=trim($request->role);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('admin/users/list')->with('message','pomyślnie utworzono użytkownika');
    }
    public function deleteUser($id)
    {
        $data['getUser']= User::getSingle($id);
        $data['id']=$id;
        if(!empty($data['getUser'])){
            return view('admin.users.delete', $data);
        }else{
            return redirect('admin/users/list')->with('message','Nie udało usunąć się użytkownika');
        }
    }
    public function deleteUserReally($data) : RedirectResponse
    {
        $user = User::getSingle($data);
        $user->delete();
        return redirect('admin/users/list')->with('message','Pomyślnie usunięto użytkownika');
    }
}
