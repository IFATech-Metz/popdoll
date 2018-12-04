
<html lang="fr" >
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <title>Ajouter une pop doll</title>
    </head>
    <body>
        <div>
            <p>AJOUTER UNE POP DOLL</p><br>
            <form class='ajout' action='formaj.php'method='get'enctype='multipart/form-data'>
                <input type='text' class='input' name='nom' value='Nom de la POP DOLL'><br><br>
                <input type='text' class='input' name='cat' value='categorie'><br><br>
                <input type='text' class='input'name='descrip' value='description'><br><br><br>
                <p>AJOUTER L'IMAGE DE LA POP DOLL:  </p><br>";
                <p style='color:red'>UNIQUEMENT .jpg</p><br>";
                <input type='file' name='photo'>
                <input type='submit'  name='valider' value='valider'>
            </form>

        
        </div>
        <?php

    if(isset($_GET["valider"])){
            $id=str_replace(" ","",$_GET["nom"]);
            $id=strtolower($id);
            $rp_txt="./txt/".$id.".txt";
            $zero="ID:".$id."\r\n"."TITRE:".trim($_GET['nom'])."\r\n"."CAT:".trim($_GET['cat'])."\r\n"."DESC: ".trim($_GET['descrip']);
            $ecri=fopen($rp_txt,"w");
            fwrite($ecri,"$zero");
            fclose($ecri);
            $ig=str_replace(" ","",$_GET["nom"]);
            $ig=strtolower($ig).".jpg";
            if (isset($_FILES['photo']['tmp_name'])){
            $taille = getimagesize($_FILES['photo']['tmp_name']);
            $largeur = $taille[0];
            $hauteur = $taille[1];
            $largeur_miniature = 700;
            $hauteur_miniature = $hauteur / $largeur * 700;
            $im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
            $im_miniature = imagecreatetruecolor($largeur_miniature
            , $hauteur_miniature);
            imagecopyresampled($im_miniature, $im, 0, 0, 0, 0, $largeur_miniature, $hauteur_miniature, $largeur, $hauteur);
            rename($_FILES["photo"]["tmp_name"],$ig);
            imagejpeg($im_miniature, 'img/'.$ig, 90);
            echo 'Popdoll ajoutée';
                }
            }
        ?>
    </body>
</html>
