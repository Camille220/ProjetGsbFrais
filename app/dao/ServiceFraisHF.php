<?php

namespace App\dao;

use App\models\Frais;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;
class ServiceFraisHF
{
    public function getFraisHF($id)
    {
        try{
            $lesFrais=DB::table('fraishorsforfait')
                ->select()
                //->where('id_frais','=',$id)
                ->orderBy('date_fraishorsforfait')
                ->get();
            return $lesFrais;

        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }
}
