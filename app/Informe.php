<?php
namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Autor;
use DB;

class Informe extends Model {

	protected $table = 'informe';
   protected $primaryKey = 'id';
   protected $fillable = [
      'titulo', 'programa_id','nivel_acad_id',
      // Metadatos de la investigación
      'modalidad_id', 'prioridad_id', 'linea_id', 'presupuesto', 'fuente_financiamiento_id', 'fuente_financiamiento_otro',
      // Personal relacionado
      // 'asesor', 'jurado1', 'jurado2', 'jurado3', 'jurado4',
      // Cronograma
      'cronograma_inicio', 'cronograma_fin', 'fecha_sustentacion',
      // Datos de la investigación
      'naturaleza_id', 'enfoque_id', 'corte_id', 'temporalidad_id', 'diseno_id', 'nivel_id',
      // Muestra y población
      'poblacion_id', 'poblacion_otro', 'muestra_id', 'muestra_otro', 'unidad_analisis', 'unidad_analisis_otro',
      // Lugar de estudio
      'ubigeo_id', 'area_estudio_id', 'area_estudio_otro',
      // Relacionado al documento
      'resumen', 'objetivos', 'producto_id','url'
   ];
	public $timestamps = False;

   public function programa(){  // PROGRAMA fk
      return $this->belongsto(Programa::class, 'programa_id', 'id');
   }
   public function nivel_acad(){  // PROGRAMA fk
      return $this->belongsto(Attribute::class, 'nivel_acad_id', 'id');
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
   public function ubigeo(){  // UBIGEO fk
      return $this->belongsto(Ubigeo::class, 'ubigeo_id', 'id');
   }
   public function area_estudio(){  // AREA ESTUDIO fk
      return $this->belongsto(Attribute::class, 'area_estudio_id', 'id');
   }
   public function producto(){  // PRODUCTO fk
      return $this->belongsto(Attribute::class, 'producto_id', 'id');
   }
   public function autor(){  // PRODUCTO fk
      $query = Autor::join('attribute','attribute.id','=','autor.condicion_id')
                      ->select(
                              DB::raw("(GROUP_CONCAT(CONCAT(persona.nombres,' ',persona.apellidos) SEPARATOR '; ')) as nombres"))
                     ->join('persona','persona.dni','=','autor.persona_id')
                     ->where('attribute.type',19)
                     ->where('autor.informe_id',$this->id)
                     ->first();
      if($query->nombres){
         return $query->nombres;
      }
      else{
         return "No registrado";
      }
   }

}
