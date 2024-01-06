<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
          'name' =>'required|string',
          'email' =>'required|email|unique:users,email',
          'password' =>'required|confirmed',
          'type'=>'required',
          'role_id'  =>'required|integer',
        ];
        if(in_array($this->method(),['PUT','PATCH'])){
            $admin = $this->route()->parameter('admin');
            $rules['email'] = 'required|email|unique:users,email,'.$admin->id;
            $rules['password'] ='nullable';
        }
        return $rules;
    }

    public function prepareForValidation()
    {
       return $this->merge([
           'type'=>'admin'
        ]);
    }
}
