<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model {

   protected $primaryKey = 'id'
   protected $fillable = [
      'titulo', 'programa_fk',
      // Metadatos de la investigación
      'modalidad', 'prioridad_inv', 'linea_inv', 'presupuesto', 'fuente_financiamiento', 'fuente_financiamiento_otro'
      // Personal relacionado
      'asesor', 'jurado1_fk', 'jurado2_fk', 'jurado3_fk', 'jurado4_fk',
      // Cronograma
      'cronograma_inicio', 'cronograma_fin', 'fecha_sustentacion',
      // Datos de la investigación
      'naturaleza', 'enfoque', 'corte', 'temporalidad', 'diseno', 'nivel',
      // Muestra y población
      'poblacion', 'poblacion_otro', 'muestra', 'muestra_otro', 'unidad_analisis', 'unidad_analisis_otro',
      // Lugar de estudio
      'ubigeo_id', 'area_estudio', 'area_estudio_otro',
      // Relacionado al documento
      'resumen', 'objetivo_general', 'objetivos_especificos', 'producto'
   ]

   public function programa(){  // Programa fk
      return $this->belongsto(Programa::class, 'programa_fk', 'id')
   }
   public function asesor(){  // ASESOR fk
      return $this->belongsto(Docente::class, 'asesor', 'codigo');
   }
   public function jurado1(){  // JURADO1 fk
      return $this->belongsto(Docente::class, 'jurado1_fk', 'codigo');
   }
   public function jurado2(){  // JURADO2 fk
      return $this->belongsto(Docente::class, 'jurado2_fk', 'codigo');
   }
   public function jurado3(){  // JURADO3 fk
      return $this->belongsto(Docente::class, 'jurado3_fk', 'codigo');
   }
   public function jurado4(){  // JURADO4 fk
      return $this->belongsto(Docente::class, 'jurado4_fk', 'codigo');
   }
   public function ubigeo(){  // UBIGEO fk
      return $this->belongsto(Ubigeo::class, 'ubigeo_id', 'id');
   }

}
