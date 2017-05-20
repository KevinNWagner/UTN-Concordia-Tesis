<?php

namespace sisAdmin;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table='tipos';
    protected $primaryKey='idTipos';

    public $timestamps=false;

    protected $fillable=[
        'Nombre',
        
    ];

    protected $guarded = [

    ];

}
