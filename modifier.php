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
      
        <img id='banniere' src="fond/bannierePetite.jpg" alt="Pop" title="Pop Dolls" />
        
        <nav>
          <ul>
              <li><a href="./index.php">Accueil</a></li>
            <li><a href="#Liste">Trier</a>
                <ul>
                    <li><a href="#Recherche">Par Titres</a></li>
                    <li><a href="#Catégories">Par Catégories</a></li>
                  </ul>
              </li>

              <li><a href="#Gestion">Gestion</a>
                  <ul>
                      <li><a href="./creer.php">Créer</a></li>
                      <li><a href="./edit_form.php">Modifier</a></li>
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
        <th class='tab'>EDITER</th>
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
            
            echo "<td><form class='clicForm' action='./fiche.php' method='POST'>

                    <button class='boutonSuppr' type='submit' name='".htmlentities(trim($tableau["ID"]))."'>
                      <img src='".$path_img."/".htmlentities(trim($tableau["ID"])).".jpg' alt='".trim($tableau["TITRE"])."' title='".trim($tableau["TITRE"])."' height='50' align='center' border='2' >
                    </button>

                    </form></td>
                  <td id='tdsuppr'><form id='suppr' action='modifier_form.php' method=POST> 
                  <input type='submit' class='boutonSuppr' name='". htmlentities(trim($tableau['ID'])) . "' value='Modifier !'>
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