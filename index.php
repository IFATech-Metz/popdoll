<?php

  $context = [
    'site' => 'PopDolls !'
  ];

  // Load Top of Page
  require_once('./src/templates/html_header.html');

  echo '<article class="collection"><header><h2>Collection</h2></header>';

  $list = [];

    if ($dir = opendir('./txt/'))
    {
      while ($entry = readdir($dir))
      {
        if ($entry != "." && $entry != "..")
        {
          $path = './txt/' . $entry;
          $list[] = yaml_parse_file($path);
        }
      }
      closedir($dir);
    }

  if (count($list) > 0) {
    $view = 'list';
    require_once('./src/templates/collection.html');
  }
  else echo '<p class="empty">Aucune entrée dans cette collection.</p>';

  echo '</article>';

  // Load Bottom of Page
  require_once('./src/templates/html_header.html');
