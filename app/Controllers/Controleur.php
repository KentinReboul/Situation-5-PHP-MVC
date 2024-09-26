<?php
//acces au controller parent pour l heritage
namespace App\Controllers;
use CodeIgniter\Controller;

//=========================================================================================
//définition d'une classe Controleur (meme nom que votre fichier Controleur.php) 
//héritée de Controller et permettant d'utiliser les raccoucis et fonctions de CodeIgniter
//  Attention vos Fichiers et Classes Controleur et Modele doit commencer par une Majuscule 
//  et suivre par des minuscules
//=========================================================================================

class Controleur extends BaseController {

//=====================================================================
//Fonction index correspondant au Controleur frontal (ou index.php) en MVC libre
//=====================================================================
public function index(){

			if(isset($_GET['action'])&&($_GET['action']=="accueil")){
				$this->redirectAccueilco();
			}
			elseif(isset($_GET['action'])&&($_GET['action']=="co")){
				$this->pageCo();
			}
			elseif(isset($_GET['action'])&&($_GET['action']=="RFF")){
				$this->redirectRFF();
			}
			elseif(isset($_GET['action'])&&($_GET['action']=="CFF")){
				$this->redirectCFF1();
			}
			elseif(isset($_POST['connexion'])){
				$this->redirectPageCo();
			}
			elseif(isset($_POST['consul'])){
				$this->consultation();
			}
			elseif(isset($_POST['deco'])){
				$this->redirectPageConnexion();
			}
			elseif(isset($_POST['ff'])){
				$this->redirectFraisForfe();
			}
			elseif(isset($_POST['hf'])){
				$this->redirecthorsForfe();
			}
		
		
			
			
		//=====================================================================
		//Code du controleur frontal	
		// dans cette fonction se retrouve le code de votre controleur frontal
		//=====================================================================	
			
		//code exemple controleur frontal
		
		 else { //cas d'affichage de l'accueil (ici forcé par le false)
				$this->accueil();
			}
	}
		//=========================
		//fin du controleur frontal
		//=========================



//======================================================
// Code du controleur simple (ex fichier Controleur.php)
//======================================================

// Action 1 : Affiche la liste de tous les billets du blog
public function accueil() {
	    //================
		//acces au modele
		//================
		
		echo view('PageAccueil');
}

// Action 2 : Affiche les détails sur un billet
public function redirectPageCo() {

		//================
		//acces au modele
		//================
		
		$login = $_POST['login'];
        $mdp = $_POST['mdp'];
        $Modele = new \App\Models\Modele();
   
        //===============================
        //Appel d'une fonction du Modele
        //===============================
        $donnees = $Modele->connexion($login,$mdp);



        if ($donnees->getNumRows() > 0) {
            $visiteur = $donnees->getRow();

            $idVisiteur = $visiteur->id;
            session_start();
            $_SESSION['idVisiteur'] = $idVisiteur;


            // Récupérer le mois en cours sous le format "YYYYMM"
                    $mois = date('m');

            $ficheExists = $Modele->verifFicheFrais($idVisiteur, $mois);

            if ($ficheExists->getNumRows() == 0) {

            $Modele->creationFicheBase($idVisiteur, $mois);
                    

            // Rediriger vers la vue d'accueil
                    
			}
			$data['resultat'] = $donnees;
            echo view('AccueilComptable', $data);
            }
			else {
            echo "Erreur : Login ou mot de passe incorrect.";
                }
			

	
}
		//===============================
		//Appel d'une fonction du Modele
		//===============================	

		
		//=================================================================================
		//!!! Création d'un jeu de données $data sécurisé pouvant etre passé à la vue
		//!!! on créé une variable qui récupère le résultat de la requete : $getBillets();
		//=================================================================================
		//$data['resultat']=$donnees;
  		
		//==========================================
		//on charge la vue correspondante
		//et on envoie le jeu de données $data à la vue
		//la vue aura acces a une variable $resultat
		//========================================= 
  
  


public function redirectRFF() {
	echo view('RFF');

  

	
}
public function pageco() {
	echo view('PageConnexion');
}

public function redirectFraisForfe() {
	$nui = $_POST['NUI'];
    $etp = $_POST['ETP'];
	$KM = $_POST['KM'];
    $REP = $_POST['REP'];
    $Modele = new \App\Models\Modele();
   
	session_start();

	if (isset($_SESSION['idVisiteur'])) {
		$idVisiteur = $_SESSION['idVisiteur'];
		$mois=date('m');
		
		$Modele = new \App\Models\Modele();
		$Modele->renseignementFicheFrais($idVisiteur, $mois, [
			'ETP' => $etp,
			'KM' => $KM,
			'NUI' => $nui,
			'REP' => $REP,
		]);

		echo view('AccueilComptable');
	}else{
		echo view('PageAccueil');
	}
}

public function redirecthorsForfe() {
	$libelle = $_POST['lib'];
    $montant = $_POST['mon'];
	$date = $_POST['dat'];
    $Modele = new \App\Models\Modele();
   
	session_start();

	if (isset($_SESSION['idVisiteur'])) {
		$idVisiteur = $_SESSION['idVisiteur'];
		$mois=date('m');
		
		$Modele = new \App\Models\Modele();
		$Modele->renseignementFicheHorsFrais($idVisiteur,$mois,$libelle,$date,$montant);

		echo view('AccueilComptable');
	}else{
		echo view('PageAccueil');
	}
}

public function redirectCFF1() {
	session_start();

	if (isset($_SESSION['idVisiteur'])) {
		$idVisiteur = $_SESSION['idVisiteur'];
	echo view('CFF1');
}else{
	echo view('PageAccueil');
}
}
 
public function redirectAccueilco() {

	session_start();

	if (isset($_SESSION['idVisiteur'])) {
		$idVisiteur = $_SESSION['idVisiteur'];

		echo view('AccueilComptable');
	}else{
		echo view('PageAccueil');
	}

}


public function consultation()
        {
            session_start(); 


        if (isset($_SESSION['idVisiteur'])) {
            $idVisiteur = $_SESSION['idVisiteur'];
            $mois=date('m');
            $mois = $_POST['mois'];

            $Modele = new \App\Models\Modele();
            $fiches = $Modele->consulteFiche($mois,$idVisiteur);

                // Passer les données à la vue pour affichage
            $data['fiches'] = $fiches;
            $data['mois'] = $mois;
            echo view('traitementConsul', $data);

        } else {
                echo "Vous devez être connecté pour accéder à cette page.";
        }
        }

// Affiche une erreur
public function erreur($msgErreur) {
  echo view('vueErreur.php', $data);
}

//==========================
//Fin du code du controleur simple
//===========================

//fin de la classe
}



?>