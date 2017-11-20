<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agente extends Model {
    protected $table = 'agentes';
    public $timestamps = false;
    protected $fillable = array('nombre','direccion','lat','lng','tipo', 'sistema', 'seguridad', 'horario','descripcion');
    
    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
    
}