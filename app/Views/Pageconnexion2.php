<?php
session_start();
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
  $conn = null;
}

// Récup des données  du formulaire
$pseudo=$_POST['pseudo'];
$password=$_POST['mdp'];

// Préparation requete
$stmt=$conn->prepare("SELECT id FROM visiteur WHERE login=:pseudo AND mdp=:mdp");

// Liaison des paramètres de la requète
$stmt->bindParam(':pseudo', $pseudo);
$stmt->bindParam(':mdp', $password);

// Exécution requête
$stmt->execute();

// Vérification des résultats
$ligne = $stmt->fetch();
if (!isset($ligne['id']))
  {
  echo "<p>Mot de passe incorrect</p>";
  require('Co.html');
}
else {
  $_SESSION['id'] = $ligne['id'];

  // Vérification de la présence de la fiche de frais pour le mois courant
  $stmt=$conn->prepare("SELECT mois FROM fichefrais WHERE idVisiteur=:visiteur AND mois=:mois");
  $mois = date('Y-m');
  $stmt->bindParam(':visiteur', $_SESSION['id']);
  $stmt->bindParam(':mois', $mois);
  $stmt->execute();
  $ligne = $stmt->fetch();

  // Si aucune fiche de frais pour le mois courant, insertion des données
  if (!$ligne){
    $stmt = $conn->prepare("INSERT INTO fichefrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) VALUES (:visiteur, :mois, 0, 0, :dateModif, 'CR')");
    $stmt->bindParam(':visiteur', $_SESSION['id']);
    $stmt->bindParam(':mois', $mois);
    $dateModif = date('Y-m-d');
    $stmt->bindParam(':dateModif', $dateModif);
    $stmt->execute();

    // Insertion des lignes de frais forfaitaires par défaut
    $fraisForfaitaires = array('KM', 'NUI', 'ETP', 'REP');
    foreach ($fraisForfaitaires as $frais) {
      $stmt = $conn->prepare("INSERT INTO lignefraisforfait (idVisiteur, mois, idFraisForfait, quantite) VALUES (:visiteur, :mois, :frais, 0)");
      $stmt->bindParam(':visiteur', $_SESSION['id']);
      $stmt->bindParam(':mois', $mois);
      $stmt->bindParam(':frais', $frais);
      $stmt->execute();
    }
  }

  
  if (!$ligne){
  // Insertion des lignes de frais  hors forfaitaires par défaut
  $stmt = $conn->prepare("INSERT INTO lignefraishorsforfait (id, idVisiteur, mois, libelle, date, montant) VALUES (1, :visiteur, :mois, :libelle, :date, :montant)");
  $stmt->bindParam(':visiteur', $_SESSION['id']);
  $stmt->bindParam(':mois', $mois);
  $date = date('Y-m-d');
  $stmt->bindParam(':libelle', $libelle);
  $stmt->bindParam(':montant', $montant);
  $stmt->fetch();
  }
  
  require('Accueil_Comptable.html');
}
?>