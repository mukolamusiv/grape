<?php

namespace App\Http\Requests\Test;

use Illuminate\Foundation\Http\FormRequest;

class OpenQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize()
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id'=>'required|integer',
            'answer'=>'required|bool'
        ];
    }
}
