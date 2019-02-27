<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nama' => 'required|max:60|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|max:60|email',
            'username' => 'required|max:60|regex:/^[a-zA-Z0-9.-_ ]*$/',
            'password' => 'required',
            'level' => 'required',
            'status' => 'required',
            'images' => 'required|file'
        ];
    }
}
