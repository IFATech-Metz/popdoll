<!DOCTYPE html>
<html>
    <head>
        <title>Modifier une PopDoll</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="./style.css" />
        <link rel="shortcut icon" href="fond/popLogo.png" />
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
    </head>

<header>
      
        <img id='banniere' src="fond/bannierePetite.jpg" alt="Pop" title="Pop Dolls"/>
        
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
                    <li><a href="./modifier.php">Modifier</a></li>
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
?>                   
            <div>
                    <p id='ajoutpop'>Vous modifiez la fiche de <?php echo $tableau['TITRE'] ?> </p><br>

                    <form class='ajout' action='' method='POST' enctype='multipart/form-data'>

                        <div class='left'>TITRE:<br> 
                        <input type='text' class='textInput' name='nom' value="<?php echo $tableau['TITRE'] ?>"></div>
                        <div class='right'>CATEGORIE:<br>
                        <input type='text' class='textInput' name='cat' value="<?php echo $tableau['CAT'] ?>"></div>
                        <br><br><br>
                        <div style='font-size: 30px;'>DESCRIPTION:<br>
                        <input type='text' class='textInput' name='desc' style="width: 80%; height: 40px" value="<?php echo $tableau['DESC'] ?>"></div>
                        <div id='ajout'>MODIFIER L'IMAGE DE LA POP DOLL:<br>
                            <div id='red'>EN .JPG UNIQUEMENT !</div>
                        </div>
                        <div class='bouton'>                    
                        <input type='file' name='photo'>
                        <input type='submit' name='valider' value='valider'>
                        </div>
                    </form>
                </div>

<?php
                }
            }
        }
    }
?>

    



    