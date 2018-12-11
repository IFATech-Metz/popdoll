<!DOCTYPE html>
<html>
    <head>

        <title>PopDolls !</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="./style.css" />
        <link rel="shortcut icon" href="fond/popLogo.png" />

    </head>
    <body>

      <header>
        <h1>PopDolls !</h1>

        <nav>
            <ul>
                <li><a href="./index.php">Accueil</a></li>
                <li><a href="#">Gestion</a>
                    <ul>
                        <li><a href="./creer.php">Créer</a></li>
                        <li><a href="./modifier.php">Modifier</a></li>
                        <li><a href="./supprimer.php">Supprimer</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

      </header>
      
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

          echo '<tr>';
          foreach ($tableau as $key => $value)
          {
            echo '<td>
              <a href="./fiche.php?id=' . $tableau['ID'] . '" title="">' . $value . '
            </td>';
          }

          echo '<td>
            <a href="./fiche.php?id=' . $tableau['ID'] . '" title="">
              <img class="imgpop" src="./' . $path_img . '/' . $tableau['ID'] . '.jpg" height="50" width="50" />
            </a>
          </td>';

          echo '</tr>';
        }
      }
      closedir($dir);
    }

?>

        </table>
 </body>
</html>
