<?php
// Connexion à la base de données
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=localhost;dbname=gsb", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Supprimer l'affichage de la connexion réussie
    // echo 'Connexion réussie';
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    // Arrêter le script en cas d'échec de connexion
    exit();
}



// Requête SQL pour sélectionner toutes les colonnes des tables lignefraisforfait et lignefraishorsforfait
$requete = $conn->query("SELECT * FROM lignefraisforfait, lignefraishorsforfait");  

// Vérification si la requête a réussi
if ($requete) {
    // Récupération des résultats
    while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
        echo $row['id']." ".$row['idVisiteur']." ".$row['quantite']." ".$row['libelle']." ".$row['date']." ".$row['montant']."<br>";
    }
} else {
    echo "Erreur lors de l'exécution de la requête.";
}

// Fermer la connexion à la base de données
$conn = null;

// Inclure le fichier CFF.php
require('traitementConsul.php');
?>