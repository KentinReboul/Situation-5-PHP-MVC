<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil</title>
  <link rel="stylesheet" href="<?php echo base_url('/public/css/StyleA.css');?>"/>
</head>
<body style="background-image: url('<?php echo base_url('public/images/couloir0.jpg'); ?>');">
  <nav>
    <ul class="sidebar">
      <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
      <li><a href="Accueil.html">Accueil</a></li>
      <li><a href="Co.html">Connexion</a></li>
    </ul>
    <ul>
      <li><a href="#">GSB.</a></li>
      <li class="hideOnMobile"><a href="getdata?action=accueil">Accueil</a></li>
      <li class="hideOnMobile"><a href="getdata?action=co">Connexion</a></li>
      <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
    </ul>
  </nav>
  <div class="text">
    <h3>
      Qui sommes-nous ?
    </h3>
    <p>
      Le laboratoire Galaxy Swiss Bourdin (GSB) est issu de la fusion entre le géant américain Galaxy 
      spécialisé dans le secteur des maladies virales (dont le SIDA et les hépatites) et le conglomérat
      européen Swiss Bourdin (travaillant sur des médicaments plus conventionnels), lui-même déjà 
      union de trois petits laboratoires.
    </p>
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