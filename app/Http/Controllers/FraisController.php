<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceFrais;
use App\Models\Frais;
use Exception;

class FraisController extends Controller
{
    public function getFraisVisiteur(){
        $erreur=Session::get('erreur');
        Session::forget('erreur');
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
            $unFrais=$serviceFrais->getById($id_frais);
            $titrevue="Modification d'une fiche de frais";
            return view('vues/formFrais',compact('unFrais','titrevue','erreur'));
        }catch(Exception $e){
            $erreur=$e->getMessage();
            return view("vues/error",compact("erreur"));
        }
    }

    public function validateFrais(Request $request)
    {
        $erreur ="";
        try{
            $id_frais =$request->input('id_frais');
            $annemois=$request->input('periode');
            $nbjustificatifs=$request->input('justificatif');
            $serviceFrais= new ServiceFrais();
            if ($id_frais >0){
                $serviceFrais->updateFrais($id_frais,$annemois,$nbjustificatifs);
            }else{
                $id_visiteur=Session::get('id');
                $serviceFrais->insertFrais($id_visiteur,$annemois,$nbjustificatifs);
            }
            return redirect('/listeFrais');

        }catch (Exception $e){
            $erreur=$e->getMessage();
            return view("vues/error",compact("erreur"));
        }
    }

    public function addFrais()
    {
        $erreur="";
        try{
            $unFrais=new Frais();
            $unFrais->id_frais=0;
            $titrevue="Ajout d'une frais";
            return view ('vues/formFrais',compact('unFrais','titrevue','erreur'));
        }catch (Exception $e){
            $erreur=$e->getMessage();
            return view("vues/error",compact("erreur"));
        }
    }

    public function removeFrais($id_frais)
    {
        $erreur="";
        try {
            $serviceFrais = new ServiceFrais();
            $serviceFrais->deleteFrais($id_frais);
        }catch (Exception $e){
            Session::put('erreur',$e->getMessage());
        }
        return redirect('/listeFrais');

    }

}
