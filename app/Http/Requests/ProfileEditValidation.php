<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileEditValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'f_name'                => 'required',
            'l_name'                => 'required', // just a normal required validation
            'email'                 => 'required|email',
            'email_confirmation'    => 'required|email|confirmed',
            'password'              => 'required',
            'password_confirm'      => 'required|same:password'

        ];
    }
}
