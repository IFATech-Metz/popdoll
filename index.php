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

<header>

        <img id='banniere' src="fond/bannierePetite.jpg" alt="Pop" title="Pop Dolls" />

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

    <body>
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
	          $path = $path_txt."/".$entry;
	          $file = fopen($path, "r");
	          while (!feof($file))
            {
              $LigneDeTexte = fgets($file);
              $parts = explode(":", $LigneDeTexte);
              $tableau[$parts[0]] = $parts[1];
            }
            fclose($file);

            $trim = trim($tableau['ID']);
            
            if (isset($_POST[$trim])) 
            {
                if (file_exists($path_img."/".$trim.".jpg") && (file_exists($path_txt."/".$trim.".txt")))
                {
                  unlink($path_img."/".$trim.".jpg");
                  unlink($path_txt."/".$trim.".txt");

                  echo '<script type="text/javascript">
                        document.location.href="./index.php";
                      </script>';
                }
            }
	          
	          echo"<tr>";
	          foreach ($tableau as $key => $value)
	            {
	              echo"<td>".$value."</td>";
	            }

	          echo "<td><form class='clicForm' action='./fiche.php' method='POST'>

	                    <button class='boutonSuppr' type='submit' name='".htmlentities(trim($tableau["ID"]))."'>
	                      <img class='imgpop' src='".$path_img."/".htmlentities(trim($tableau["ID"])).".jpg' alt='".trim($tableau["TITRE"])."' title='".trim($tableau["TITRE"])."' height='50' align='center' border='2' >
	                    </button>

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
