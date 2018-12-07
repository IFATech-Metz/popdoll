<!DOCTYPE html>
<html>
    <head>

        <title>Détails</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="./style.css" />
        <link rel="shortcut icon" href="fond/popLogo.png" />

    </head>

<header>

        <img id='banniere' src="fond/bannierePetite.jpg" alt="Pop" title="Pop Dolls"/>

    <nav>
        <ul>
            <li><a href="./index.php">Accueil</a></li>
            <li><a href="#Gestion">Gestion</a>
                <ul>
                    <li><a href="./creer.php">Créer</a></li>
                    <li><a href="./modifier.php">Modifier</a></li>
                    <li><a href="./supprimer.php">Supprimer</a></li>
                </ul>
            </li>
        </ul>
    </nav>

</header>


   <body>

      <?php
      if ($_GET AND $_GET['id']) $reqID = $_GET['id'];

      $path_txt = "./txt";
      $path_img = "./img";

      if (isset($reqID) AND file_exists($path_txt . '/' . $reqID . '.txt')) {
        $tableau = yaml_parse_file($path_txt . '/' . $reqID . '.txt');
        echo '<div class="fiche">
          <p class="ajoutpop">' . $tableau['TITRE'] . '</p>
          <p><img class="imgFiche" src="' . $path_img . '/' . $tableau['ID'] . '.jpg" height="300"></p>
          <div class="categorie">Catégorie: <br>' . $tableau['CAT'] . '</div><br>
          <p class="description">' . $tableau['DESC'] . '</p><br>
        </div>';
      } else {
        // throw 404: do send header before content /!\
        ?>
        <section>
          <header>
            <h2>Introuvable</h2>
            <h3>Erreur 404</h3>
          </header>
          <p>La fiche demandée n'existe pas.</p>
        </section>
        <?php
      }

      ?>
    </body>
    
</html>
