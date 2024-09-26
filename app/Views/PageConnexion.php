<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="<?php echo base_url('/public/css/StyleCo.css');?>"/>
</head>
<body style="background-image: url('<?php echo base_url('public/images/couloir0.jpg'); ?>');">
  <nav>
    <ul class="sidebar">
      <li><a href="Accueil.html">Accueil</a></li>
      <li><a href="Co.html">Connexion</a></li>
    </ul>
    <ul>
      <li><a href="#">GSB.</a></li>
      <li class="hideOnMobile"><a href="getdata?action=accueil">Accueil</a></li>
      <li class="hideOnMobile"><a href="getdata?action=co">Connexion</a></li>
    </ul>
  </nav>

  <form class="formul" action="postdata" method="POST">
    <p>Pseudo: </p>
    <input type="text" name="login" id="pseudo"/>
    <br/>
    <p>Mot de passe: </p>
    <input type="password" name="mdp" id="mdp"/>
    <br/>
    <input type="submit" name="connexion" value="Connexion"/>
  </form>

  <footer>
    <ul class="pied">
        <li><a href="#">Conditions générales</a></li>
        <li><a href="#">Paramètre des cookies</a></li>
        <li><a href="#">Mentions légales</a></li>
    </ul>
  </footer>

</body>
</html>