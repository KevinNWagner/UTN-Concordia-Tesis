<?php

namespace sisAdmin\Http\Requests;

use sisAdmin\Http\Requests\Request;

class UFormRequest extends Request
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
             'name' => 'max:255|unique:users',
            'email' => 'email|max:255',
            'password' => 'required|min:6|confirmed',
            'idtipo' => 'required|integer',
        ];
    }
}
