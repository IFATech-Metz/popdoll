<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./style.css" />
    <link rel="shortcut icon" href="logo/pop.png" />
    <title>Pop Dolls</title>
  </head>
  <body>

    <header>
      
        <img class='imgban' src="fond/banniere.jpg" alt="Pop" title="Pop Dolls"
        style='max-width:100%;height:auto;' />
        
        <nav>
          <ul>
              <li><a href="./index.php">Accueil</a></li>
              <li><a href="#Liste">Liste</a>
                  <ul>
                      <li><a href="#Recherche">Recherche</a></li>
                      <li><a href="#Catégories">Catégories</a></li>
                  </ul>
              </li>

              <li><a href="#Gestion">Gestion</a>
                  <ul>
                      <li><a href="./formaj.php">Créer</a></li>
                      <li><a href="./edit.php">Modifier</a></li>
                      <li><a href="./delete.php">Supprimer</a></li>
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
        <th class='tab'>IMAGE</th>
        <th class='tab'>EDITION</th>
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
          $path = $path_txt."/".$entry;
          $file = fopen($path, "r");

          while (!feof($file))
            {
              $LigneDeTexte = fgets($file);
              $parts = explode(":", $LigneDeTexte);
              $tableau[$parts[0]] = $parts[1];
            }
          fclose($file);
          echo"<tr>";

          foreach ($tableau as $key => $value)
            {
              echo"<td>".$value."</td>";
            }
            
            echo "<td><a target='_blank' href='" . $path_img . "/" . $tableau["ID"] . ".jpg'>
                  <img class='imgpop' title='".$tableau["TITRE"]."'src='".$path_img."/".$tableau["ID"].
                  ".jpg'height='50' align='center' border='2' ></a></td>
                  <td><form action='edit_form' method=POST> 
                  <input type='submit' name='". trim($tableau['ID']) . "' value='modifier'>
                  </form></td>";
          echo "</tr>";
          
        }
      }
      closedir($dir);
    }
    
?>

    </table>
  </body>
</html>
