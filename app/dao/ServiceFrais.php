<?php

namespace App\dao;

use App\models\Frais;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;
class ServiceFrais
{
    public function getFrais($id)
    {
        try{
            $lesFrais=DB::table('frais')
                ->select()
                ->where('id_visiteur','=',$id)
                ->orderBy('anneemois')
                ->get();
            return $lesFrais;

        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getById($id){
        try{
            $lesFrais=DB::table('frais')
                ->select()
                ->where('id_visiteur','=',$id)
                ->first();
            return  $lesFrais;
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function updateFrais($idfrais,$anneemois,$nbjustificatifs)
    {
     try{
         $aujourdhui = date("Y-m-d");
         DB::table('frais')
             ->where('id_visiteur',$idfrais)
             ->update(['datemodifications'=>$aujourdhui,'anneemois'=>$anneemois,'nbjustificatif'=>$nbjustificatifs]);

     }catch (QueryException $e){
         throw new MonExcption($e->getMessage(),5);
     }
    }

    public function insertFrais($idvisiteur,$anneemois,$nbjustificatifs)
    {
        try{
            $aujourdhui = date("Y-m-d");
            DB::table('frais')
                ->insert(['datemodification'=>$aujourdhui,
                    'id_etat'=>2,
                    'id_visiteur'=>$idvisiteur,
                    'anneemois'=>$anneemois,
                    'nbjustificatif'=>$nbjustificatifs]
                );
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }

}
