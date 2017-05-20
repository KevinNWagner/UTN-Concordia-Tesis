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
    //tesitn
}

