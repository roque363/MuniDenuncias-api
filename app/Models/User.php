<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = array('nombre','email','password','tipo');
    //Ocultar las contraseñas
    //protected $hidden = ['created_at', 'updated_at','password'];
    
    public function agentes() {
        return $this->belongsToMany('App\Models\Agente');
    }
    
}
