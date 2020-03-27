<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
            if ( auth()->user()->hasRole('Admin') )
            {
                return true;
            }
            return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =[
            'name' => 'required|min:2',
            'email' => ['required', 'email' ],
            'username' => ['required','string'],
            'phone' => ['numeric'],
            'lastname' => ['string']
        ];

        if ($this->filled('password')) {
            $rules['password'] = ['confirmed', 'min:6'];
        }

        return $rules;
        }
}
