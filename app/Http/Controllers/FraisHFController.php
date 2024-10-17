<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceFraisHF;
use App\Models\Frais;
use Exception;

class FraisHFController extends Controller
{
    public function getFraisHF(){
        $erreur=Session::get('erreur');
        Session::forget('erreur');
        try{
            $id=Session::get('id');
            $serviceFrais=new ServiceFraisHF();
            $mesFrais=$serviceFrais->getFraisHF($id);
            return view('vues/listeFraisHF',compact('mesFrais','erreur'));
        }catch(Exception $e){
            $erreur=$e->getMessage();
            return view("vues/error",compact("erreur"));
        }
    }

}
