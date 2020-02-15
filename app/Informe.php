<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model {

	protected $table = 'informe';
   protected $primaryKey = 'id';
   protected $fillable = [
      'titulo', 'programa_id',
      // Metadatos de la investigación
      'modalidad', 'prioridad', 'linea', 'presupuesto', 'fuente_financiamiento', 'fuente_financiamiento_otro',
      // Personal relacionado
      'asesor', 'jurado1', 'jurado2', 'jurado3', 'jurado4',
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
   ];
	public $timestamps = False;

   public function programa(){  // Programa fk
      return $this->belongsto(Programa::class, 'programa_id', 'id');
   }
   public function asesor(){  // ASESOR fk
      return $this->belongsto(Docente::class, 'asesor', 'codigo');
   }
   public function jurado1(){  // JURADO1 fk
      return $this->belongsto(Docente::class, 'jurado1', 'codigo');
   }
   public function jurado2(){  // JURADO2 fk
      return $this->belongsto(Docente::class, 'jurado2', 'codigo');
   }
   public function jurado3(){  // JURADO3 fk
      return $this->belongsto(Docente::class, 'jurado3', 'codigo');
   }
   public function jurado4(){  // JURADO4 fk
      return $this->belongsto(Docente::class, 'jurado4', 'codigo');
   }

   public function programa(){  // PROGRAMA fk
      return $this->belongsto(Programa::class, 'programa_id', 'id');
   }
   public function modalidad(){  // MODALIDAD fk
      return $this->belongsto(Attribute::class, 'modalidad_id', 'id');
   }
   public function prioridad(){  // PRIORIDAD fk
      return $this->belongsto(Attribute::class, 'prioridad_id', 'id');
   }
   public function linea(){  // LINEA fk
      return $this->belongsto(Attribute::class, 'linea_id', 'id');
   }
   public function fuente_financiamiento(){  // FUENTE FINANCIAMIENTO fk
      return $this->belongsto(Attribute::class, 'fuente_financiamiento_id', 'id');
   }
   public function naturaleza(){  // NATURALEZA fk
      return $this->belongsto(Attribute::class, 'naturaleza_id', 'id');
   }
   public function enfoque(){  // ENFOQUE fk
      return $this->belongsto(Attribute::class, 'enfoque_id', 'id');
   }
   public function corte(){  // CORTE fk
      return $this->belongsto(Attribute::class, 'corte_id', 'id');
   }
   public function temporalidad(){  // TEMPORALIDAD fk
      return $this->belongsto(Attribute::class, 'temporalidad_id', 'id');
   }
   public function diseno(){  // DISEÑO fk
      return $this->belongsto(Attribute::class, 'diseno_id', 'id');
   }
   public function nivel(){  // NIVEL fk
      return $this->belongsto(Attribute::class, 'nivel_id', 'id');
   }
   public function poblacion(){  // POBLACION fk
      return $this->belongsto(Attribute::class, 'poblacion_id', 'id');
   }
   public function muestra(){  // MUESTRA fk
      return $this->belongsto(Attribute::class, 'muestra_id', 'id');
   }
   public function unidad_analisis(){  // UNIDAD ANALISIS fk
      return $this->belongsto(Attribute::class, 'unidad_analisis_id', 'id');
   }
   public function ubigeo(){  // UBIGEO fk
      return $this->belongsto(Ubigeo::class, 'ubigeo_id', 'id');
   }
   public function area_estudio(){  // AREA ESTUDIO fk
      return $this->belongsto(Attribute::class, 'area_estudio_id', 'id');
   }
   public function producto(){  // PRODUCTO fk
      return $this->belongsto(Attribute::class, 'producto_id', 'id');
   }

}
