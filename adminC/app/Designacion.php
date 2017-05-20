<?php

namespace sisAdmin;

use Illuminate\Database\Eloquent\Model;

class Designacion extends Model
{
     protected $table='designaciones';
    protected $primaryKey='idDesignaciones';

    public $timestamps=false;

    protected $fillable=[
        'Cronogramas_idCronogramas',      
        'Empleados_idEmpleados',
        'Colectivos_idColectivos',
        
    ];

    protected $guarded = [

    ]; 
}
