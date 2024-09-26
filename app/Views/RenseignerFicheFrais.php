<?php
// Connexion bdd
$username = 'root';
$password ='';

try { 
    $conn= new PDO("mysql:host=localhost;dbname=gsb",$username,$password);
          $conn->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo 'Connexion échouée : ' .$e->getMessage();
// Connexion fermée
    exit();
}
session_start();
// Récup des données  du formulaire
$mois = date('Y-m');
$FraisKilometrique=$_POST['KM'];
$ForfaitEtape=$_POST['ETP'];
$NuiteeHotel=$_POST['NUI'];
$RepasRestaurant=$_POST['REP'];
$date = date ('Y-m-d');
$libelle = $_POST["libelle"];
$montant = $_POST["montant"];

// Préparation et exécution des requêtes SQL
try {
    // Modification des lignes de frais forfaitaire
    $stmt = $conn->prepare("UPDATE lignefraisforfait SET quantite = :KM WHERE idVisiteur = :id AND mois = :mois AND idFraisForfait = 'KM'");
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->bindParam(':mois', $mois);
    $stmt->bindParam(':KM', $FraisKilometrique);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE lignefraisforfait SET quantite = :ETP WHERE idVisiteur = :id AND mois = :mois AND idFraisForfait = 'ETP'");
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->bindParam(':mois', $mois);
    $stmt->bindParam(':ETP', $ForfaitEtape);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE lignefraisforfait SET quantite = :NUI WHERE idVisiteur = :id AND mois = :mois AND idFraisForfait = 'NUI'");
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->bindParam(':mois',  $mois);
    $stmt->bindParam(':NUI', $NuiteeHotel);
    $stmt->execute();  

    $stmt = $conn->prepare("UPDATE lignefraisforfait SET quantite = :REP WHERE idVisiteur = :id AND mois = :mois AND idFraisForfait = 'REP'");
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->bindParam(':mois',  $mois);
    $stmt->bindParam(':REP', $RepasRestaurant);
    $stmt->execute(); 
    
    $stmt = $conn->prepare("UPDATE lignefraishorsforfait SET montant = :montant, date = :date, libelle = :libelle WHERE idVisiteur = :visiteur AND mois = :mois");
    $stmt->bindParam(':visiteur', $_SESSION['id']);
    $stmt->bindParam(':mois',  $mois);
    $stmt->bindParam(':montant', $montant);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':libelle', $libelle);
    $stmt->execute();    

}
catch (PDOException $e) {
    echo 'Erreur lors de l\'insertion de vos données : ' . $e->getMessage();
}
require('RFF.html');
?>