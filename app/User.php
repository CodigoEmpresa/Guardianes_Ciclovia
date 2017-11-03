<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

      protected $table = 'usuario';

      
       public function ciudad(){
        
        return $this->belongsTo('App\Ciudad','id_ciudad');

       }
        public function pais(){
        
        return $this->belongsTo('App\Pais','id_pais');

       }
        public function departamento(){
        
        return $this->belongsTo('App\Departamento','id_departamento');

       }
  
}
