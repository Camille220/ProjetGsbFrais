<?php

namespace App\dao;

use App\models\Frais;

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
                ->where('id_frais','=',$id)
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
             ->update(['datemodification'=>$aujourdhui,'anneemois'=>$anneemois,'nbjustificatifs'=>$nbjustificatifs]);

     }catch (QueryException $e){
         throw new MonException($e->getMessage(),5);
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
                    'nbjustificatifs'=>$nbjustificatifs]
                );
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }


    public function deleteFrais($idfrais)
    {
        try{
            DB::table('frais')
                ->where('id_frais',$idfrais)
                ->delete();
        }catch (QueryException $e){
            $erreur=$e->getMessage();
            if($e->getCode()==23000){
                $erreur="Impossible de supprimer une fiche ayant des frais liés";
            }
            throw new MonException($erreur,5);
        }
    }
}
