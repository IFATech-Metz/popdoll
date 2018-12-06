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
                        <li><a href="./creer.php">Créer</a></li>
                        <li><a href="./edit.php">Modifier</a></li>
                        <li><a href="./supprimer.php">Supprimer</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    
    </header>

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
?>                   
            <div>
                    <p>MODIFICATION DE LA DOLL </p><br>
                    <form class='ajout' action='' method='POST' enctype='multipart/form-data'>
                        
                        <div><?php echo $tableau['ID'] ?></div>

                        <input type='text' class='input' name='id' value="<?php echo $tableau['ID'] ?>" hidden><br>

                        TITRE : <br>
                        <input type='text' class='input' name='titre' value="<?php echo $tableau['TITRE'] ?>" autofocus><br>

                        CATEGORIE :<br>
                        <input type='text' class='input' name='cat' value="<?php echo $tableau['CAT'] ?>"><br>

                        DESCRIPTION :<br>
                        <input type='text' class='input' name='desc' value="<?php echo $tableau['DESC'] ?>" style="width: 80%; height: 100px"><br><br><br>
                       
                        <p>IMAGE ACTUELLE : </p>
                        <img src='<?php echo $path_img."/".$id_tableau.".jpg" ?>' height='150'>

                        <p>MODIFIER L'IMAGE  </p><br>
                        <p style='color:red'>UNIQUEMENT .jpg</p><br>

                        <input type='file' name='photo'>
                        <p><input type='submit'  name='valider' value='valider'>
                        </p>
                    </form>
                </div>

<?php
                }
            }
        }
    }

    if (isset($_POST["valider"]))
    {
        $rp_txt="./txt/".$_POST['id'].".txt";
        $zero="ID:".$_POST['id']."\r\n"."TITRE:".trim($_POST['titre'])."\r\n"."CAT:".trim($_POST['cat'])."\r\n"."DESC: ".trim($_POST['desc']);
        $ecri=fopen($rp_txt,"w");

        fwrite($ecri,"$zero");
        fclose($ecri);

        if (isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name']))
        {
            $ig=$_POST['id'];
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

        }
        
        echo '<script type="text/javascript">
            document.location.href="./index.php";
            </script>';
    }
?>

    

    


    