<?php

namespace sisAdmin;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    protected $table='cronogramas';
    protected $primaryKey='idCronogramas';

    public $timestamps=false;

    protected $fillable=[
        'Carteleras_idCarteleras',      
        'fecha',
        
    ];

    protected $guarded = [

    ]; 
}
