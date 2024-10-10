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
            $annemois=$request->input('annemois');
            $nbjustificatifs=$request->input('nbjustificatifs');
            $serviceFrais= new ServiceFrais();
            if ($id_frais >0){
                $serviceFrais->updateFrais($id_frais);
            }else{
                $id_visiteur=$request->input('id_visiteur');
                $serviceFrais->insertFrais($id_visiteur,$annemois,$nbjustificatifs);
            }
            return redirect('/getListeFrais');

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
            $unFrais->if_frais=0;
            $titrevue="Ajout d'une frais";
            return view ('vues/formFrais',compact('unFrais','titrevue','erreur'));
        }catch (Exception $e){
            $erreur=$e->getMessage();
            return view("vues/error",compact("erreur"));
        }
    }

}
