<?php

namespace sisAdmin\Http\Requests;

use sisAdmin\Http\Requests\Request;

class RendicionChoferFormRequest extends Request
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
            'recaudacion'=> 'required|regex:/^\d*(\.\d{1,2})?$/',
            'fecha'=> 'DATE|required',
            'observacionAdmin' =>'VARCHAR|max:200',
            'boletoPrimera' => 'required|integer|max:11',
            'beletoSegunda'=> 'required|integer|max:11',
            'boletoEscolar' => 'required|integer|max:11',
            'boletoSecundario'=> 'required|integer|max:11',
            'boletoJubilado' => 'required|integer|max:11',
            'boleteoCombinado' => 'required|integer|max:11',
            'Empleados_idEmpleados' => 'required|integer|max:11',
            'Colectivos_idColectivos'=> 'required|integer|max:11',
        ];
    }
}

/*
-- -----------------------------------------------------
-- Table 'db_administracion_colectivos'.'rendiciones_boleteras'
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS 'db_administracion_colectivos'.'rendiciones_boleteras' (
  'idRendicionesBoleteras' INT(11) NOT NULL AUTO_INCREMENT,
  'recaudacion' DECIMAL(10,2) NULL DEFAULT NULL,
  'fecha' DATETIME NOT NULL,
  'observacionAdmin' VARCHAR(200) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  'boletoPrimera' INT(11) NULL DEFAULT NULL,
  'beletoSegunda' INT(11) NULL DEFAULT NULL,
  'boletoEscolar' INT(11) NULL DEFAULT NULL,
  'boletoSecundario' INT(11) NULL DEFAULT NULL,
  'boletoJubilado' INT(11) NULL DEFAULT NULL,
  'boleteoCombinado' INT(11) NULL DEFAULT NULL,
  'Empleados_idEmpleados' INT(11) NOT NULL,
  'Colectivos_idColectivos' INT(11) NOT NULL,
  PRIMARY KEY ('idRendicionesBoleteras'),
*/