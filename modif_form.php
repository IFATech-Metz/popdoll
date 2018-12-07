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
                    $trim_tab = trim($tableau['ID']);
                }

            }
        }
        echo "$trim_tab";

       if (isset($_GET["flash"]))
       {
         echo "test";

       }



        ?>
       <!--<div>
           <p id='ajout'>AJOUTER UNE POP DOLL: </p><br>
           <form id='entre' action='fred_photo.php'method='get'>

            TITRE:<br>
            <input type="text" name="titre" required value="">
            <br>
            CATEGORIE:<br>
            <input type="text" name="cat" required value="">
            <br>
            DESCRIPTION:<br>
            <input type="text" name="desc" required value="">
            <br>
            <input type="submit" name="valider" value="Enregistrer !">
            <br>


           </form>
       </div>-->

   <?php

      /* if(isset($_GET["valider"]))
       {

           $id=str_replace(" ","",$_GET["titre"]);
           $id=strtolower($id);
           $rp_txt="./txt/".$id.".txt";
           $zero="ID:".$id."\r\n"."TITRE:".trim($_GET['titre'])."\r\n"."CAT:".trim($_GET['cat'])."\r\n"."DESC: ".trim($_GET['desc']);
           $ecri=fopen($rp_txt,"w");

           fwrite($ecri,"$zero");
           fclose($ecri);

           echo "<p id='ajout'>Ajouter l'image de la PopDoll:</p>";
           echo "<p id='red'>UNIQUEMENT .jpg !</p>";
           echo "<form method='post' enctype='multipart/form-data'>

                  <input type='file' name='Photo'>
                  <input type='submit' value='Ajouter !'>

                </form>";
       }

       if (isset($_FILES['photo']['tmp_name']))
       {

           $ig=str_replace(" ","",$_GET["titre"]);
           $ig=strtolower($ig).".jpg";
           $taille = getimagesize($_FILES['photo']['tmp_name']);
           $largeur = $taille[0];
           $hauteur = $taille[1];
           $largeur_miniature = 700;
           $hauteur_miniature = $hauteur / $largeur * 700;
           $im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
           $im_miniature = imagecreatetruecolor($largeur_miniature, $hauteur_miniature);

           imagecopyresampled($im_miniature, $im, 0, 0, 0, 0, $largeur_miniature, $hauteur_miniature, $largeur, $hauteur);

           rename($_FILES["photo"]["tmp_name"],$ig);

           imagejpeg($im_miniature, 'img/'.$ig, 90);

           echo "<br><br><p id='ajout'>L'image " . $ig . " a bien été téléversée.</p>";
       }*/
    ?>
   </body>
</html>
