<?php

  // Load Doll class
  require_once('../models/doll.php');

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
