<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

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

    //zwróć wszystkie oceny do tabeli
    static public function getGrades(){
        return self::select('grades.*')
            ->orderBy('id','asc')
            ->paginate(15);
    }
    static public function getSingle($id){
        return self::find($id);
    }
}
