<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    protected $table = 'kardex';

       public function impuestos() {
   		return $this->belongsTo('App\Impuesto','impuestos_id');
   }

   public function unimed() {
   		return $this->belongsTo('App\UnidadMedida','unimed_id');
   }
   public function empresa()  {
   		return $this->belongsTo('App\Empresa','empre_id');
   }
   public function producto()  {
   		return $this->belongsTo('App\Producto','producto_id');
   }
}
