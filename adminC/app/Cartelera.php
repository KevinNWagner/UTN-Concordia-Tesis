<?php

namespace sisAdmin;

use Illuminate\Database\Eloquent\Model;

class Cartelera extends Model
{
    protected $table='carteleras';
    protected $primaryKey='idCarteleras';

    public $timestamps=false;

    protected $fillable=[
        'horaInicio',
        'horaFin',
        'cantidadPersonas',
        'duracionRecorrido',
        'descripcion',
        
    ];

    protected $guarded = [

    ]; 
}

/*
-- -----------------------------------------------------
-- Table `db_Administracion_Colectivos`.`Carteleras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_Administracion_Colectivos`.`Carteleras` (
  `idCarteleras` INT NOT NULL AUTO_INCREMENT,
  `horaInicio` DATETIME NOT NULL,
  `horaFin` DATETIME NOT NULL,
  `cantidadPersonas` INT NOT NULL,
  `duracionRecorrido` TIME NOT NULL,
  PRIMARY KEY (`idCarteleras`))
ENGINE = InnoDB;

*/