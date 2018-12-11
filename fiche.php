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

      if (isset($reqID) AND file_exists('./txt/' . $reqID . '.txt')) {
        $tableau = yaml_parse_file('./txt/' . $reqID . '.txt');
        require('./src/templates/doll.html');
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
