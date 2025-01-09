<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
/*    public function authorize(): bool
    {
        return false;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mark' => ['required', 'string', 'max:255'],
            'lecturer_id' => ['required'],
            'description' => ['max:255'],
            'subject' => ['required', 'string', 'max:255', 'min:2'],
            'student_id' => 'required|string|exists:users,id',
        ];
    }
}
