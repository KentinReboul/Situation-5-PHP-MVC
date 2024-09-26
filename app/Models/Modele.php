<?php
// Accès au Modèle parent pour l'héritage
namespace App\Models;
use CodeIgniter\Model;



//=========================================================================================
//définition d'une classe Modele (meme nom que votre fichier Modele.php) 
//héritée de Modele et permettant d'utiliser les raccoucis et fonctions de CodeIgniter
//  Attention vos Fichiers et Classes Controleur et Modele doit commencer par une Majuscule 
//  et suivre par des minuscules
//=========================================================================================
class Modele extends Model {

//==========================
// Code du modele
//==========================

//=========================================================================
// Fonction 1
// récupère les données BDD dans une fonction getBillets
// Renvoie la liste de tous les billets, triés par identifiant décroissant
//=========================================================================
public function connexion($login,$mdp) { 

//==========================================================================================
// Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
//==========================================================================================
	$db = db_connect();

//=============================
// rédaction de la requete sql
//=============================


// Vérification si une fiche de frais existe déjà pour l'utilisateur et le mois
    $sql ='SELECT id FROM visiteur WHERE login = ? AND mdp = ? ';

	
//=============================
// execution de la requete sql
//=============================	
    $resultat = $db->query($sql,[$login,$mdp]);

//=============================
// récupération des données de la requete sql
//=============================

//=============================
// renvoi du résultat au Controleur
//=============================	
    return $resultat;
   
}

public function verifFicheFrais($idVisiteur, $mois) {


    $db = db_connect();

    $sql = 'SELECT * FROM fichefrais WHERE idVisiteur = ? AND mois = ?';

    $resultat = $db->query($sql, [$idVisiteur, $mois]);
 
    return $resultat;
    }
    public function creationFicheBase($idVisiteur,$mois) { 

        //==========================================================================================
        // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
        //==========================================================================================
        $db = db_connect();
        
         // Insertion dans la table fichefrais
         $sql = "INSERT INTO fichefrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) 
         VALUES ('$idVisiteur', '$mois', 0, 0, '" . date('d-m-Y') . "', 'CR')";
        $db->query($sql, [$idVisiteur,$mois]);
        
        // Insertion dans la table lignefraisforfait pour ETP
        $sql = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite) 
         VALUES ('$idVisiteur', '$mois', 'ETP', 0)";
        $db->query($sql, [$idVisiteur,$mois]);
        
        // Insertion pour KM
        $sql = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite) 
         VALUES ('$idVisiteur', '$mois', 'KM', 0)";
        $db->query($sql, [$idVisiteur,$mois]);
        
        // Insertion pour NUI
        $sql = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite) 
         VALUES ('$idVisiteur', '$mois', 'NUI', 0)";
        $db->query($sql, [$idVisiteur,$mois]);
        // Insertion pour REP
        $sql = "INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite) 
         VALUES ('$idVisiteur', '$mois', 'REP', 0)";
        $db->query($sql, [$idVisiteur,$mois]);
        
    }


    public function renseignementFicheFrais($idVisiteur,$mois,$frais) { 

        //==========================================================================================
        // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
        //==========================================================================================
    
         // Insertion dans la table fichefrais
         $db = db_connect();
         $builder = $db->table('lignefraisforfait');
    
         // Mise à jour des frais pour chaque type de frais
         foreach ($frais as $idFraisForfait => $quantite) {
             $builder->set('quantite', $quantite);
             $builder->where('idFraisForfait', $idFraisForfait);
             $builder->where('idVisiteur', $idVisiteur);
             $builder->where('mois', $mois);
             $builder->update();
        }
    }
    public function renseignementFicheHorsFrais($idVisiteur,$mois,$libelle,$date,$montant) { 

        //==========================================================================================
        // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
        //==========================================================================================
        $db = db_connect();
            
        $sql = "INSERT INTO lignefraishorsforfait (idVisiteur,mois,libelle,date,montant) 
        VALUES ('$idVisiteur', '$mois','$libelle', '$date','$montant')";
        $db->query($sql, [$idVisiteur,$mois,$libelle, $date,$montant]);
            
            
    }    
    public function consulteFiche($mois,$idVisiteur) { 

        //==========================================================================================
        // Connexion à la BDD en utilisant les données féninies dans le fichier app/Config/Database.php
        //==========================================================================================
        $db = db_connect();
    
        $sql = "SELECT * FROM lignefraisforfait WHERE mois = ? AND idVisiteur= ? ";
        $resultat= $db->query($sql, [$mois,$idVisiteur]);
        $sql = "SELECT * FROM lignefraishorsforfait WHERE mois = ? AND idVisiteur= ?";
        $resultat1 = $db->query($sql, [$mois,$idVisiteur]);
    
        return [
            'ligneFraisForfait' => $resultat->getResult(),
            'ligneFraisHorsForfait' => $resultat1->getResult()
        ];
    
    
    }
//=========================================================================
// Fonction 2 
// récupère les données BDD dans une fonction getDetails
// Renvoie le détail d'un billet précédemment sélectionné par son id
//=========================================================================

//==========================
// Fin Code du modele
//===========================


//fin de la classe
}


?>