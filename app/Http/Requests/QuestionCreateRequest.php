<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class QuestionCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'question' => 'required|min:3', 
            'image' => 'image|nullable|max:1024|mimes:jpg,jpeg,png',
            'answer1' => 'required', 
            'answer2' => 'required', 
            'answer3' => 'required', 
            'answer4' => 'required', 
            'correct_answer' => 'required', 

        ];
    }
    public function attributes()
    {
        return [
            'question' => 'Soru', 
            'image' => 'Soru Fotoğrafı',
            'answer1' => '1.Cevap',
            'answer2' => '2.Cevap', 
            'answer3' => '3.Cevap', 
            'answer4' => '4.Cevap', 
            'correct_answer' => 'Doğru Cevap', 

        ];
    }
}
