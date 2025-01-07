<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function addSubject(Request $request)
    {
        return view('subjects.addSubject', [
            'addSubject',
        ]);
    }

    public function editSubject(Request $request)
    {

    }
}
