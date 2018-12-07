<!DOCTYPE html>
<html>
    <head>
        <title>Ajouter une PopDoll</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="./style.css" />
        <link rel="shortcut icon" href="fond/popLogo.png" />
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
    </head>
<header>
        <img id='banniere' src="fond/banniere.jpg" alt="Pop" title="Pop Dolls"/>
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
                    <li><a href="./supprimer.php">Supprimer</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>


   <body>
       <?php
       $path_txt = "./txt";
       $path_img = "./img";
       if ($dir = opendir($path_txt))
       {
           while ($entry = readdir($dir))
           {
               if ($entry != "." && $entry != "..")
               {
                   $path = $path_txt."/".$entry;
                   $file = fopen($path, "r");
                   $file_id = str_replace(".txt", "", $entry);

                   if (isset($_POST["$file_id"]))
                   {
                       $path_txt_id = $path_txt."/".$file_id.".txt";
                       $open_id = fopen($path_txt_id, "r");

                       while (!feof($open_id))
                       {
                           $LigneDeTexte = fgets($open_id);
                           $parts = explode(":", $LigneDeTexte);
                           $tableau[$parts[0]] = $parts[1];
                       }
                       $id_tableau = $tableau['ID'];
                       echo print_r($tableau);
                   }
               }
           }
       }
                 ?>
        <div>
             <p> <?php echo $tableau['TITRE'] ?><p><br>
            <img src='<?php echo $path_img."/".$id_tableau.".jpg" ?>' height='300'><br>
            <p><?php echo $tableau['CAT'] ?></p><br><br>
            <p><?php echo $tableau['DESC'] ?></p><br>
        </div>
    </body>
</html>
