<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Grade;
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
    public function listGrades(){
        $data['getGrades'] = Grade::getGrades();
        return view('admin.grades.list', $data);
    }
    public function addGrade(){
        return view('admin.grades.add');
    }
    //zrobić walidacje
    public function storeGrade(Request $request) : RedirectResponse
    {
        $grade = new Grade();
        $grade->is_valid = 1;
        $grade->create($request->all());
        return redirect('admin/grades/add')->with('message','Pomyślnie dodano ocenę.');
    }

    public function listUsers(){
        $data['getUsers'] = User::getUsers();
        return view('admin.users.list', $data);
    }
    public function addUser(){
        return view('admin.users.add');
    }
    public function storeUser(UserUpdateRequest $request) : RedirectResponse
    {
        //dd($request->all());
        $user = new User();
        //$request->merge(['user_id' => Auth::user()->id]);
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
    public function updateUser($id, UserUpdateRequest $request): RedirectResponse
    {
        $user = User::getSingle($id);

        $active_email=$user->email;

        $user->name=trim($request->name);
        $user->surname=trim($request->surname);
        $user->role=trim($request->role);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        if($request->email!=null){
            $user->email = $request->email;
            //żeby nie krzyczał że email musi być unikalny
            if($user->email==$active_email){
                request()->validate([
                    'email' =>  Rule::unique(User::class)->ignore($user->id)
                ]);
            }
        }else{
            $user->email = $active_email;
        }

        $user->insert();

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
