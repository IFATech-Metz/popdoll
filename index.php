<?php

  $context = [
    'site' => 'PopDolls !'
  ];

  // Load Top of Page
  require_once('./src/templates/html_header.html');
?>

      <table>
        <tr>
          <th class='tab'>ID</th>
          <th class='tab'>TITRE</th>
          <th class='tab'>CATEGORIE</th>
          <th class='tab'>DESCRIPTION</th>
          <th class='tab'>DETAILS</th>
        </tr>

<?php

    $path_txt = "./txt";
    $path_img = "./img";
    $tableau = array();
    if ($dir = opendir($path_txt))
    {
      while ($entry = readdir($dir))
      {
        if ($entry != "." && $entry != "..")
        {
          $path = $path_txt . '/' . $entry;
          $tableau = yaml_parse_file($path);

          // Load Doll Template
          require('./src/templates/doll_list.html');

        }
      }
      closedir($dir);
    }

  // Load Bottom of Page
  require_once('./src/templates/html_header.html');
