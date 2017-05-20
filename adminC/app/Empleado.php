<?php

namespace sisAdmin;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table='empleados';
    protected $primaryKey='idEmpleados';

    public $timestamps=false;

    protected $fillable=[
        'nombre',
        'apellido',
        'domicilio',
        'telefono',
        'celular',
        'fechaNacimiento',
        'fechaAntiguedad',
        'turno',
        'name',        
        
        
    ];

    protected $guarded = [

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