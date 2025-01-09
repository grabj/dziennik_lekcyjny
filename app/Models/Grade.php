<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Nullable;

class Grade extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * @var int|mixed
     */
    protected $fillable = [
        'mark',
        'student_id',
        'lecturer_id',
        'subject',
        'description',
        'is_valid'
    ];

    protected $attributes = [
        'is_valid' => true,
    ];

    //zwróć oceny do tabeli admina
    static public function getGrades(){
        return self::select(
            'grades.*',
            'lecturers.name as lecturer_name',
            'lecturers.surname as lecturer_surname',
            'students.name as student_name',
            'students.surname as student_surname'
        )
            ->join('users as lecturers', 'grades.lecturer_id', '=', 'lecturers.id') // Alias for lecturers
            ->join('users as students', 'grades.student_id', '=', 'students.id') // Alias for students
            ->orderBy('id','asc')
            ->paginate(15);
    }

    //zwróć wszystkie oceny nauczyciela
    static public function getYourGrades($userId) {
        return self::select('grades.*', 'users.name as lecturer_name', 'users.surname as lecturer_surname')
            ->join('users', 'grades.lecturer_id', '=', 'users.id')
            ->where('student_id', $userId)
            ->where('is_valid', 1)
            ->orderBy('updated_at', 'desc')
            ->paginate(15);
    }

    //zwróć wszystkie oceny ucznia
    static public function getCreatedGrades($userId) {
        return self::select('grades.*', 'users.name as student_name', 'users.surname as student_surname')
            ->join('users', 'grades.student_id', '=', 'users.id')
            ->where('lecturer_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->paginate(15);
    }

    static public function getSingle($id){
        return self::find($id);
    }
}
