<?php

  $context = [
    'site' => 'PopDolls !',
    'banniere' => 'small'
  ];

  // Load Top of Page
  require_once('./src/templates/html_header.html');
?>

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

  // Load Bottom of Page
  require_once('./src/templates/html_header.html');
