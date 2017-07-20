<?php

namespace sisAdmin;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table='reportes_inspectores';
    protected $primaryKey='idRendicionesBoleteras';

    public $timestamps=false;

    protected $fillable=[
            'recaudacion',
            'fecha',
            'observacionAdmin' ,
            'boletoPrimera',
            'beletoSegunda',
            'boletoEscolar' ,
            'boletoSecundario',
            'boletoJubilado' ,
            'boleteoCombinado' ,
            'Empleados_idEmpleados' ,
            'Colectivos_idColectivos',            
    ];
     protected $guarded = [

    ]; 

}
