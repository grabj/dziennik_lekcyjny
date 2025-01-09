<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function listGrades(){
        $userId = Auth::id();
        $data['getYourGrades'] = Grade::getYourGrades($userId);
        return view('student.grades.list', $data);
    }
}
