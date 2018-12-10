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
	                   }
	               }
	           }
	       }
       ?>
          <div class='fiche'>

            <p class='ajoutpop'> <?php echo $tableau['TITRE'] ?></p>
            <br>
            <a href='<?php echo $path_img."/".trim(htmlentities($id_tableau)).".jpg" ?>' target='_blank'>
            	<img class='imgFiche' src='<?php echo $path_img."/".trim(htmlentities($id_tableau)).".jpg" ?>' 
                alt='<?php echo trim($tableau["TITRE"])?>' title="<?php echo "Cliquez pour agrandir l'image"?>" height='300'></a>
        	<br>
            <div class='categorie'>Catégorie: <br><?php echo $tableau['CAT'] ?></div>
        	<br>
            <p class='description'><?php echo $tableau['DESC'] ?></p>
            <br>

        <?php
            $confirmation = "return confirm(\"Voulez-vous supprimer ". trim($tableau['TITRE']) ." de votre catalogue ?\")";

            echo "<form id='suppr' action='modifier_form.php' method='POST'> 
                <input type='submit' class='boutonSuppr' name='". htmlentities(trim($tableau['ID'])) . "' value='Modifier !'>
                </form>
                <form id='suppr' action='index.php' method='POST'> 
                <input class='boutonSuppr' type='submit' onclick='".$confirmation."' name='". htmlentities(trim($tableau['ID'])) . "' value='Supprimer !'>
                </form>";
        ?>

          </div>

    </body>
</html>
