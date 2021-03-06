<?php

namespace App\Http\Requests\Lecturer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Lecturer;

class UpdateLecturerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'nidn' => [
                'required',
                Rule::unique(Lecturer::class, 'nidn')->ignore($this->id)
            ],
            'lecturer_photo' => [
                'image',
                'mimes:jpg',
                Rule::dimensions()->maxWidth(1200)->maxHeight(700),
            ],
            'college_id' => 'required',
            'study_program' => 'required',
            'gender' => 'required', 
            'last_education' =>'required'
        ];
    }
}
