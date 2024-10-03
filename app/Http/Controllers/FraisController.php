<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceFrais;
use Exception;

class FraisController extends Controller
{
    public function getFraisVisiteur(){
        $erreur="";
        try{
            $id=Session::get('id');
            $serviceFrais=new ServiceFrais();
            $mesFrais=$serviceFrais->getFrais($id);
            return view('vues/listeFrais',compact('mesFrais','erreur'));
        }catch(Exception $e){
            $erreur=$e->getMessage();
            return view("vues/error",compact("erreur"));
        }
    }

    public function updateFrais($id_frais)
    {
        $erreur="";
        try {
            $serviceFrais=new ServiceFrais();
            $unfrais=$serviceFrais->getById($id_frais);
            $titrevue="Modification d'une fiche de frais";
            return view('vues/updateFrais',compact('unfrais','titrevue'));
        }catch(Exception $e){
            $erreur=$e->getMessage();
            return view("vues/error",compact("erreur"));
        }
    }

}
