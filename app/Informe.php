<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model {

   protected $primaryKey = 'id'
   protected $fillable = [
      'titulo', 'programa_id',
      // Metadatos de la investigación
      'modalidad', 'prioridad_inv', 'linea_inv', 'presupuesto', 'fuente_financiamiento', 'fuente_financiamiento_otro'
      // Personal relacionado
      'asesor_id', 'judado1', 'judado2', 'judado3', 'judado4',
      // Cronograma
      'cronograma_inicio', 'cronograma_fin', 'fecha_sustentacion',
      // Datos de la investigación
      'naturaleza', 'enfoque', 'corte', 'temporalidad', 'diseno', 'nivel',
      // Muestra y población
      'poblacion', 'poblacion_otro', 'muestra', 'muestra_otro', 'unidad_analisis', 'unidad_analisis_otro',
      // Lugar de estudio
      'ubigeo_id', 'area_estudio', 'area_estudio_otro',
      // Relacionado al documento
      'resumen', 'objetivo_general', 'objetivos_especificos', 'productos'
   ]

   public function asesor(){  // ASESOR fk
      return $this->belongsto(User::class, 'asesor_id', 'dni');
   }
   public function jurado1(){  // JURADO1 fk
      return $this->belongsto(User::class, 'jurado1', 'dni');
   }
   public function jurado2(){  // JURADO2 fk
      return $this->belongsto(User::class, 'jurado2', 'dni');
   }
   public function jurado3(){  // JURADO3 fk
      return $this->belongsto(User::class, 'jurado3', 'dni');
   }
   public function jurado4(){  // JURADO4 fk
      return $this->belongsto(User::class, 'jurado4', 'dni');
   }
   public function ubigeo(){  // UBIGEO fk
      return $this->belongsto(Ubigeo::class, 'ubigeo_id', 'id');
   }

}
