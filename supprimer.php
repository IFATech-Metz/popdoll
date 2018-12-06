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
      
        <img id='banniere' src="fond/banniere.jpg" alt="Pop" title="Pop Dolls" />
        
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
                    <li><a href="./creer.php">Créer</a></li>
                    <li><a href="./edit.php">Modifier</a></li>
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
        <th class='tab'>IMAGE</th>
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
            
            echo "<td><a target='_blank' href='" . $path_img . "/" . $tableau["ID"] . ".jpg'>
                  <img class='imgpop' title='".$tableau["TITRE"]."'src='".$path_img."/".$tableau["ID"].
                  ".jpg'height='50' align='center' border='2' ></a></td>
                  <td id='tdsuppr'><form id='suppr' action='' method=POST> 
                  <input type='submit' name='". trim($tableau['ID']) . "' value='Supprimer'>
                  </form></td>";
          echo "</tr>";
          
          $tab_id = trim($tableau['ID']);

          if (isset($_POST["$tab_id"])) 
          {
            unlink($path_txt."/".$tab_id.".txt");
            unlink($path_img."/".$tab_id.".jpg");

            echo '<script type="text/javascript">
                document.location.href="./supprimer.php";
                </script>'; 
          }
        }
      }
      closedir($dir);
    }  
?>

    </table>
  </body>
</html>