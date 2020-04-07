<?php

namespace App\Imports;

use App\Persona;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //Para que reconozca con cabeceras $row['email'], 
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class PersonaImport implements ToCollection, WithHeadingRow
{

   public function collection(Collection $rows)
    {   
        foreach ($rows as $row) 
        {
           if ($this->validar($row)) {
                $this->set_persona($row);
            }
        }
    }


    public function validar($row){
        $dni=true;
        if (strlen($row['dni'])!=8 || !is_numeric($row['dni']) || $row['nombres']=='' || $row['apellidos']=='') {
            $dni=false;
        }
        return $dni;
    }

    public function set_persona($row){
        $user=Persona::find($row['dni']);
        if(!$user){
            $user = new Persona;
        }
        $user->dni= $row['dni'];
        $user->nombres= $row['nombres'];
        $user->apellidos= $row['apellidos'];
        if($row['genero']=='1') $genero='1';
        else $genero='0';
        $user->genero= $genero;
        $user->save(); 
        return $user->dni;
    }

}

