<?php
namespace App\Controllers;
use App\Models\ModeleAdministrateur;
use App\Models\ModeleClient; 
use App\Models\ModeleLiaison;
use App\Models\ModeleTarif;
use App\Models\ModelePeriode;
use App\Models\ModeleSecteur;
use App\Models\ModeleTraverse;


helper(['assets']); 
 
class Client extends BaseController
{
    public function reservetraverse($noreservation = null)
    {
        
        return view('Templates/Header') 
        . view('Client/ReserveTraverser')
        . view('Templates/Footer'); 
        
        
    }
}   