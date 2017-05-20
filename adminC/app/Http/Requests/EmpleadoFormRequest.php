<?php

namespace sisAdmin\Http\Requests;

use sisAdmin\Http\Requests\Request;

class EmpleadoFormRequest extends Request
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
        'nombre' => 'max:50| required',
        'apellido' =>'max:50| required',
        'domicilio'=> 'max:100' ,
        'telefono'=> 'max:45' ,
        'celular'=> 'max:45' ,
        'fechaNacimiento'=>  'date|required' ,
        'fechaAntiguedad'=>  'date|required' ,
        'turno'=> 'integer|max:1' ,
        'name'=> 'max:45|unique:empleados' ,        
        
        ];
    }
        /*
            -- -----------------------------------------------------
        -- Table `db_Administracion_Colectivos`.`Empleados`
        -- -----------------------------------------------------
        CREATE TABLE IF NOT EXISTS `db_Administracion_Colectivos`.`Empleados` (
        `idEmpleados` INT NOT NULL AUTO_INCREMENT,
        `nombre` VARCHAR(50) NOT NULL,
        `apellido` VARCHAR(50) NOT NULL,
        `domicilio` VARCHAR(100) NULL,
        `telefono` VARCHAR(45) NULL,
        `celular` VARCHAR(45) NULL,
        `fechaNacimiento` DATE NULL,
        `fechaAntiguedad` DATE NULL,
        `turno` TINYINT(1) NULL,
        `usuario` VARCHAR(45) NULL,
        `contraseña` VARCHAR(45) NULL,
        `Tipos_idTipos` INT NOT NULL,
        PRIMARY KEY (`idEmpleados`),
        INDEX `fk_Empleados_Tipos_idx` (`Tipos_idTipos` ASC),
        CONSTRAINT `fk_Empleados_Tipos`
            FOREIGN KEY (`Tipos_idTipos`)
            REFERENCES `db_Administracion_Colectivos`.`Tipos` (`idTipos`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION)
        ENGINE = InnoDB;
        */
}
