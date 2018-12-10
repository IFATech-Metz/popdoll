<!DOCTYPE html>
<html>
    <head>

        <title>Ajouter une PopDoll</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="./style.css" />
        <link rel="shortcut icon" href="fond/popLogo.png" />

    </head>

<header>

        <img id='banniere' src="fond/bannierePetite.jpg" alt="Pop" title="Pop Dolls"/>

    <nav>
        <ul>
            <li><a href="./index.php">Accueil</a></li>
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

		$titre = !empty($_POST['titre']) ? $_POST['titre'] : '';
		$cat = !empty($_POST['cat']) ? $_POST['cat'] : '';
		$desc = !empty($_POST['desc']) ? $_POST['desc'] : '';

	 ?>
       <div>

          	<p class='ajoutpop'>AJOUTER UNE POP DOLL: </p><br>

          	<form class='ajout' action='' method='POST' enctype='multipart/form-data'>

			    <?php

			        if(isset($_POST["valider"]) && isset($_FILES['photo']['tmp_name']))
			        {

			            $id=str_replace(" ","",$_POST["titre"]);
			            $id=strtolower($id);
			            $rp_txt="./txt/".htmlentities($id).".txt";

			            if (file_exists($rp_txt))
			            {
			                $echo ="<p class='ajoutpop' id='deja'>Ce titre est déjà utilisé <br> Merci d'en utiliser un autre</p>";
			                echo $echo;
			            }
			            else
			            {
			              
				            $zero="ID:".htmlentities($id)."\r\n"."TITRE:".htmlentities(trim($_POST['titre']))."\r\n"."CAT:".htmlentities(trim($_POST['cat']))."\r\n"."DESC: ".htmlentities(trim($_POST['desc']));
				            $ecri=fopen($rp_txt,"w");

				            fwrite($ecri,"$zero");
				            fclose($ecri);

				            $ig=str_replace(" ","",htmlentities($_POST["titre"]));
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
				            unlink("./".htmlentities($id).".jpg");


				            echo '<script type="text/javascript">
				                	document.location.href="./index.php";
				                </script>';
			        	}
			   		}	
			    ?>

	            <div class='left'>TITRE:<br>
	            	<input class='textInput' type="text" name="titre" required value="<?php echo $titre; ?>">
	        	</div>

	            <div class='right'>CATEGORIE:<br>
	            	<input class='textInput' type="text" name="cat" required value="<?php echo $cat; ?>">
	        	</div>

	            <br><br><br>

	            <div class='center';'>DESCRIPTION:<br>
	            	<input type="text" class='textInput' name="desc" required value="<?php echo $desc; ?>" style="width: 80%; height: 40px">
	        	</div>

	            <div id='ajout'>Ajouter l'image de la PopDoll:<br>
		            <div id='red'>UNIQUEMENT .jpg !</div>
	        	</div>

	            <div class='bouton'>
		            <input type='file' class='boutonSuppr' name='photo' required value="">
		            <input type="submit" class='boutonSuppr' name="valider" value="Enregistrer !">
	            </div>

            </form>
       </div>

   </body>
</html>
