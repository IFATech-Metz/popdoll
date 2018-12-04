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
?>                   
            <div>
                    <p>AJOUTER UNE POP DOLL</p><br>
                    <form class='ajout' action='' method='POST' enctype='multipart/form-data'>
                        <input type='text' class='input' name='nom' value="<?php echo $tableau['TITRE'] ?>"><br><br>
                        <input type='text' class='input' name='cat' value="<?php echo $tableau['CAT'] ?>"><br><br>
                        <input type='text' class='input' name='descrip' value="<?php echo $tableau['DESC'] ?>"><br><br><br>
                    
                        <p>AJOUTER L'IMAGE DE LA POP DOLL:  </p><br>
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
?>

    

    


    