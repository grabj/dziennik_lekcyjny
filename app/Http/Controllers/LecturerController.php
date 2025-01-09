<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeStoreRequest;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use http\Message;

class LecturerController extends Controller
{
    public function listGrades(){
        $userId = Auth::id();
        $data['getCreatedGrades'] = Grade::getCreatedGrades($userId);
        return view('lecturer.grades.list', $data);
    }
    public function invalidGrade(Request $request) : RedirectResponse
    {
        $grade = Grade::getSingle($request->id);
        if($grade->is_valid){
            $grade->is_valid = 0;
        }else{
            $grade->is_valid = 1;
        }
        $grade->update();
        return redirect('lecturer/grades/list')->with('message','Zmieniono ważność oceny.');
    }
    public function addGrade(){
        $data['lecturer_id'] = Auth::id();
        $data['students'] =
            User::select('id', 'name', 'surname')
                ->where('role','=','2')
                ->get();
        return view('lecturer.grades.add', $data);
    }
    public function storeGrade(GradeStoreRequest $request) : RedirectResponse
    {
        //$lecturer_id = Auth::id();
        $grade = new Grade();
        //$grade->lecturer_id = $lecturer_id;
        $grade->create($request->all());
        return redirect('lecturer/grades/add')->with('message','Pomyślnie dodano ocenę.');
    }
}
