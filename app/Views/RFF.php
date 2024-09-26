<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Renseigner fiche de frais</title>
  <link rel="stylesheet" href="<?php echo base_url('/public/css/StyleRFF.css');?>"/>
</head>
<body style="background-image: url('<?php echo base_url('public/images/couloir0.jpg'); ?>');">
  <nav>
    <ul class="sidebar">
      <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
      <li><a href="Accueil.html">Accueil</a></li>
      <li><a href="RFF.html">Renseigner fiche de frais</a></li>
      <li><a href="CFF.php">Consulter fiche de frais</a></li>
      <li><a href="Co.html">Connexion</a></li>
    </ul>
    <ul>
      <li><a href="#">GSB.</a></li>
      <li class="hideOnMobile"><a href="getdata?action=accueil">Accueil</a></li>
      <li class="hideOnMobile"><a href="getdata?action=RFF">Renseigner fiche de frais</a></li>
      <li class="hideOnMobile"><a href="getdata?action=CFF">Consulter fiche de frais</a></li>
      <li class="hideOnMobile"><a href="getdata?action=deco">Déconnexion</a></li>
      <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
    </ul>
  </nav>

<div class="container">
    <h1>Saisie Des Fiches De Frais</h1>
    <h2>FICHE FRAIS</h2>
    </br>
    <form action="postdata" method="POST">
      <input type="FF" name="ETP" placeholder="Forfait"/>
      <br/>
      <br/>
      <input type="Fk" name="KM" placeholder="Frais Kilométriques"/>
      <br/>
      <br/>
      <input type="Fk" name="NUI" placeholder="Nuitée Hôtel"/>
      <br/>
      <br/>
      <input type="Fk" name="REP" placeholder="Repas Restaurant"/>
      </br>
      </br>
      <input type="submit" class="btn" name="ff" value="valider">
    </form>
    <form action="postdata" method="POST">
      <h2>FICHE HORS FRAIS</h2>
      <input type="text" name="lib" placeholder="Libellé">
      </br>
      <br/>
      <input type="date" id="start" name="dat" required>
      </br>
      <br/>
      <input type="number" name="mon" placeholder="montant" required>
      </br>
      <br/>
      <input type="submit" class="btn" name="hf" value="valider">
    </form>
  <a href="Accueil_Comptable.html" class="PageAcceuil">Retour</a>
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
      const sidebar = document.querySelector('.sidebar')
      sidebar.style.display = 'flex'
    }
    function hideSidebar(){
      const sidebar = document.querySelector('.sidebar')
      sidebar.style.display = 'none'
    }
  </script>
</body>
</html>