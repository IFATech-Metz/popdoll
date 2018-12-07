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
            <li><a href="#Liste">Trier</a>
                <ul>
                    <li><a href="#Recherche">Par Titres</a></li>
                    <li><a href="#Catégories">Par Catégories</a></li>
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
                    $id_tableau = $tableau['ID'];
?>                   
                <div>
                    <p class='ajoutpop'>Vous modifiez la fiche de <?php echo $tableau['TITRE'] ?> </p><br>

                    <form class='ajout' action='' method='POST' enctype='multipart/form-data'>

                        <input type='text' class='input' name='id' value="<?php echo $tableau['ID'] ?>" hidden><br>
                        <div class='left'>TITRE:<br> 
                        <input type='text' class='textInput' name='titre' value="<?php echo $tableau['TITRE'] ?>"></div>
                        <div class='right'>CATEGORIE:<br>
                        <input type='text' class='textInput' name='cat' value="<?php echo $tableau['CAT'] ?>"></div>
                        <br><br><br>
                        <div class='center'>DESCRIPTION:<br>
                        <input type='text' class='textInput' name='desc' style="width: 80%; height: 40px" value="<?php echo $tableau['DESC'] ?>"></div>
                        <div>IMAGE ACTUELLE :<br>
                        <img src='<?php echo $path_img."/".htmlentities($id_tableau).".jpg" ?>' height='150'>
                        </div>
                        <div id='ajout'>MODIFIER L'IMAGE DE LA POP DOLL:<br>
                            <div id='red'>EN .JPG UNIQUEMENT !</div>
                        </div>
                        <div class='bouton'>                    
                        <input type='file' class='boutonSuppr' name='photo'>
                        <input type='submit' class='boutonSuppr' name='valider' value='valider'>
                        </div>

                    </form>
                </div>
<?php
                }
            }
        }
    }
    if (isset($_POST["valider"]))
    {
        $rp_txt="./txt/".htmlentities($_POST['id']).".txt";
        $zero="ID:".htmlentities($_POST['id'])."\r\n"."TITRE:".htmlentities(trim($_POST['titre']))."\r\n"."CAT:".htmlentities(trim($_POST['cat']))."\r\n"."DESC: ".htmlentities(trim($_POST['desc']));
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
    </body>
</html>    



    