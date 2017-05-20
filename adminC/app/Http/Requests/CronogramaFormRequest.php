<?php

namespace sisAdmin\Http\Requests;

use sisAdmin\Http\Requests\Request;
use DateTime;

class CronogramaFormRequest extends Request
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
            'Carteleras_idCarteleras'=>'required',      
            'fecha'=>'required|date|unique:cronogramas',
        ];
    }
    protected function getValidatorInstance()
    {
    $data = $this->all();
    $data['fecha'] = DateTime::createFromFormat('d-m-Y', $data['fecha'])->format("Y-m-d");
    $this->getInputSource()->replace($data);

    /*modify data before send to validator*/

    return parent::getValidatorInstance();
    }
}
