<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserStoreRequest;
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
    //OCENY

    public function listGrades(){
        $data['getGrades'] = Grade::getGrades();
        return view('admin.grades.list', $data);
    }
    public function addGrade(){
        return view('admin.grades.add');
    }
    public function storeGrade(GradeStoreRequest $request) : RedirectResponse
    {
        $grade = new Grade();
        $grade->create($request->all());
        return redirect('admin/grades/add')->with('message','Pomyślnie dodano ocenę.');
    }
    public function deleteGrade($id)
    {
        $data['getGrade']= Grade::getSingle($id);
        $data['id']=$id;
        if(!empty($data['getGrade'])){
            return view('admin.grades.delete', $data);
        }else{
            return redirect('admin/grades/list')->with('message','Nie udało usunąć się oceny.');
        }
    }
    public function deleteGradeReally($data) : RedirectResponse
    {
        $grade = Grade::getSingle($data);
        $grade->delete();
        return redirect('admin/grades/list')->with('message','Pomyślnie usunięto ocenę.');
    }

    //UŻYTKOWNICY

    public function listUsers(){
        $data['getUsers'] = User::getUsers();
        return view('admin.users.list', $data);
    }
    public function addUser(){
        return view('admin.users.add');
    }
    public function storeUser(UserStoreRequest $request) : RedirectResponse
    {
        //dd($request->all());
        $user = new User();
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
        $user->name=trim($request->name);
        $user->surname=trim($request->surname);
        $user->email = trim($request->email);
        $user->role=trim($request->role);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $request->merge(['user_id' => $user->id]);

        $user->update();

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
