<?php

  // Load Doll class
  require_once('../models/doll.php');

  switch ($req['method']) {

    case 'GET':
      // Load Top of Page
      require_once('../templates/html_header.html');
      echo '<article class="collection"><header><h2>Collection</h2></header>';
      // Render every Doll listed
      if (false !== ($list = Doll::list($req['query']['order']['by'], $req['query']['order']['sort']))) {
        require('../templates/collection.html');
      }
      else echo '<p class="empty">Aucune entrée dans cette collection.</p>';
      echo '</article>';
      // Load Bottom of Page
      require_once('../templates/html_footer.html');
      break;

    case 'POST':
      if (!$req['query']['handle']) {
        http_response_code(400);
        break;
      }
      if (false !== ($doll = Doll::add($req['query']))) {
        http_response_code(201);
        break;
      }
      http_response_code(400);
      break;

    default:
      http_response_code(405);
  }
