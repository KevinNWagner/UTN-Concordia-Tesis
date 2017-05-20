<?php

namespace sisAdmin;

use Illuminate\Database\Eloquent\Model;

class Colectivo extends Model
{
        protected $table='colectivos';
    protected $primaryKey='idColectivos';

    public $timestamps=false;

    protected $fillable=[
        'marca',
        'modelo',
        'matricula',
        'posicionLatitud',
        'posicionLongitud',
        
    ];

    protected $guarded = [

    ]; 
}
