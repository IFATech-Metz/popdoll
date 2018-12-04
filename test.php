<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./style.css" />
        <link rel="shortcut icon" href="fond/popLogo.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Page Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
    </head>
<header>
        <img src="fond/banniere.jpg" alt="Pop" title="Pop Dolls" style="max-width:100%;height:auto;" />
    <nav>
        <ul>
            <li><a href="./index.php">Accueil</a></li>
            <li><a href="#Liste">Liste</a>
                <ul>
                    <li><a href="#Recherche">Recherche</a></li>
                    <li><a href="#Catégorie">Catégorie</a></li>
                </ul>
            </li>
            <li><a href="#Gestion">Gestion</a>
                <ul>
                    <li><a href="./creer.php">Créer</a></li>
                    <li><a href="#Modifier">Modifier</a></li>
                    <li><a href="#Supprimer">Supprimer</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
    <body>

    <?php
    header('Content-Type: text/html; charset=utf-8');
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
          sort($tableau);
          echo"<tr>";
          foreach ($tableau as $key => $value)
            {
              echo"<td>".$value."</td>";
            }
          echo "<td><a target='_blank' href='".$path_img."/".$tableau["ID"].".jpg'><img class='imgpop' title='".$tableau["TITRE"]."' src='".$path_img."/".$tableau["ID"].".jpg' height='50' align='center' border='2' ></a></td>";
          echo "</tr>";
        }
      }
      closedir($dir);

    }
    ?>


    </body>
</html>
