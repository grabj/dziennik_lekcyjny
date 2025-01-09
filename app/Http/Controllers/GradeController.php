<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function listGrades(){
        $data['getGrades'] = Grade::getGrades();
        return view('admin.grades.list', $data);
    }
    public function addGrade(){
        return view('admin.grades.add');
    }
}
