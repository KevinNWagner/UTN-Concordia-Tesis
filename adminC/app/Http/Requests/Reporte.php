<?php

namespace sisAdmin;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table='reportes_inspectores';
    protected $primaryKey='idReportesInspectores';

    public $timestamps=false;

    protected $fillable=[
            'descripcion',
            'fecha',
            'Colectivos_idColectivos' ,
            'Empleados_idEmpleadosChofer',
            'Empleados_idEmpleadosInspector',
                       
    ];
     protected $guarded = [

    ]; 

}
