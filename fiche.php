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
       header('Content-Type: text/html; charset=utf-8');
       $path_txt = "./txt";
       $path_img = "./img";
       $id=$_GET[trim($tableau['ID'])];
       $tableau = array();
       if ($dir = opendir($path_txt))
       {
         while ($entry = readdir($dir))
         {
           if ($entry != "." && $entry != ".."  )
           {
             $entry = $id ;
             $path = $path_txt."/".$entry;
             $file = fopen($path, "r");

                 $LigneDeTexte = fgets($file);
                 $parts = explode(":", $LigneDeTexte);
                 $tablea[$parts[0]] = $parts[1];
               
             fclose($file);
             echo $tablea["TITRE"];
         }
     }
 }
        ?>
       <div>





   </body>
</html>
