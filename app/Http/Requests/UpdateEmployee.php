<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployee extends FormRequest
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
        $id = $this->route('employee');
        return [
            'employee_id' => 'required|unique:users,employee_id,' . $id,
            'name' => 'required',
            'phone' => 'required|min:9|max:11|unique:users,phone,' . $id,
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'required|min:4|max:255',
            'nrc_number' => 'required|min:3',
            'gender' => 'required',
            'dep_id' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
            'date_of_join' => 'required|date',
            'is_present' => 'required'
        ];
    }
}
