<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Doctrine\Inflector\Rules\Ruleset;
use http\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function listUsers(){
        $data['getUsers'] = User::getUsers();
        return view('admin.users.list', $data);
    }
    public function addUser(){
        return view('admin.users.add');
    }
    public function storeUser(ProfileUpdateRequest $request) : RedirectResponse
    {
        //dd($request->all());
        $user = new User();
        $request->merge(['user_id' => Auth::user()->id]);
        $user->create($request->all());
        return redirect('admin/users/add')->with('message','Pomyślnie utworzono użytkownika');
    }
    public function editUser($id){
        $data['getUsers']= User::getSingle($id);
        if(!empty($data['getUsers'])){
            return view('admin.users.edit', $data);
        }else{
            abort(404);
        }
    }
    public function updateUser($id, ProfileUpdateRequest $request): RedirectResponse
    {
        $user = User::getSingle($id);

        $active_email=$user->email;

        $user->name=trim($request->name);
        $user->surname=trim($request->surname);
        $user->role=trim($request->role);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }

        //żeby nie krzyczał że email musi być unikalny
        if($user->email==$active_email){
            request()->validate([
                'email' =>  Rule::unique(User::class)->ignore($user->id)
            ]);
        }

        $user->save();

        return redirect('admin/users/list')->with('message','Pomyślnie zaktualizowano użytkownika');
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
