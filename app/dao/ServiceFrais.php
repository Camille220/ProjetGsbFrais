<?php

namespace App\dao;

use App\models\Frais;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;
class ServiceFrais
{
    public function getFrais()
    {
        try{
            $lesFrais=DB::table('frais')
                ->select()
                ->where('id_visiteur','=','id')
                ->orderBy('date_frais')
                ->first();
            return $lesFrais;

        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }
}
