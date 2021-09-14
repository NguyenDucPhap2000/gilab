<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewRequest extends FormRequest
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
            'name'=>'required|min:6|max:30',
            'dateofbirth'=>'required|date',
            're-password'=>'same:password|confirmed',
            'account'=>'required|min:6|max:30',
            'password'=>'|required|min:8|max:30',
            'email'=>'required|email:rfc,dns'
        ];
    }
}
