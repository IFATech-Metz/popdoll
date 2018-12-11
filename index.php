<?php

  $context = [
    'site' => 'PopDolls !'
  ];

  // Load Doll class
  require_once('./src/models/doll.php');

  // Load Top of Page
  require_once('./src/templates/html_header.html');

  echo '<article class="collection"><header><h2>Collection</h2></header>';

  // Render every Doll listed
  if (false !== ($list = Doll::list($_REQUEST['order']['by'],$_REQUEST['order']['sort']))) {
    $view = 'list';
    if ($_REQUEST['view']) $view = $_REQUEST['view'];
    require('./src/templates/collection.html');
  }
  else echo '<p class="empty">Aucune entrée dans cette collection.</p>';

  echo '</article>';

  // Load Bottom of Page
  require_once('./src/templates/html_header.html');
