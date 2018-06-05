<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class usercrear extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//siempre colocar true
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
            'email'=>['required','email','unique:users,email'],
            'password'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'campo nombre es obligatorio',
            'email.required'=>'campo email es obligatorio',
            'password.required'=>'campo password es obligatorio',
            'email.email'=>'el texto que se introdujo en campo email no es un email',
            'email.unique'=>'Ya existe un usuario con este email',
        ];
    }
}
