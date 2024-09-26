<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil</title>
  <link rel="stylesheet" href="<?php echo base_url('/public/css/StyleCFF.css');?>"/>
</head>
<body style="background-image: url('<?php echo base_url('public/images/couloir0.jpg'); ?>');">
  <nav>
  <nav>
    <ul class="sidebar">
      <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
      <li><a href="Accueil.html">Accueil</a></li>
      <li><a href="RFF.html">Renseigner fiche de frais</a></li>
      <li><a href="CFF.php">Consulter fiche de frais</a></li>
      <li><a href="Co.html">Déconnexion</a></li>
    </ul>
    <ul>
      <li><a href="#">GSB.</a></li>
      <li class="hideOnMobile"><a href="getdata?action=accueil">Accueil</a></li>
      <li class="hideOnMobile"><a href="getdata?action=RFF">Renseigner fiche de frais</a></li>
      <li class="hideOnMobile"><a href="getdata?action=CFF">Consulter fiche de frais</a></li>
      <li class="hideOnMobile"><a href="getdata?action=deco">Déconnexion</a></li>
      <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
    </ul>
  </nav>
  <div class="consultation">
    <h1>Liste des données</h1>
    <h2>Frais Forfait</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID Visiteur</th>
                <th>Mois</th>
                <th>ID Frais Forfait</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Afficher les données des frais forfaits dans le tableau
            foreach ($fiches['ligneFraisForfait'] as $row): 
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row->idVisiteur) . "</td>";
                echo "<td>" . htmlspecialchars($row->mois) . "</td>";
                echo "<td>" . htmlspecialchars($row->idFraisForfait) . "</td>";
                echo "<td>" . htmlspecialchars($row->quantite) . "</td>";
                echo "</tr>";
            endforeach; // Ajout de 'endforeach' pour clore la boucle
            ?>
        </tbody>
    </table>
    
    <h2>Frais Hors Forfait</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID Visiteur</th>
                <th>Mois</th>
                <th>Libellé</th>
                <th>Date</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Afficher les données des frais hors forfait dans le tableau
            foreach ($fiches['ligneFraisHorsForfait'] as $row): 
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row->idVisiteur) . "</td>";
                echo "<td>" . htmlspecialchars($row->mois) . "</td>";
                echo "<td>" . htmlspecialchars($row->libelle) . "</td>";
                echo "<td>" . htmlspecialchars($row->date) . "</td>";
                echo "<td>" . htmlspecialchars($row->montant) . "</td>";
                echo "</tr>";
            endforeach; // Ajout de 'endforeach' pour clore la boucle
            ?>
        </tbody>
    </table>
</div>


  <footer>
    <ul class="pied">
      <li><a href="#">Conditions générales</a></li>
      <li><a href="#">Paramètre des cookies</a></li>
      <li><a href="#">Mentions légales</a></li>
    </ul>
  </footer>

  <script>
    function showSidebar(){
      const sidebar = document.querySelector('.sidebar');
      sidebar.style.display = 'flex';
    }
    function hideSidebar(){
      const sidebar = document.querySelector('.sidebar');
      sidebar.style.display = 'none';
    }
  </script>
</body>
</html>
