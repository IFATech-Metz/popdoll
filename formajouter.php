<html>
   <body>
       <form method="post" enctype="multipart/form-data">
           <input type="file" name="photo">
           <input type="submit" value="ajouter">

       </form>
       <?php
       if (isset($_FILES['photo']['tmp_name'])) {
           $taille = getimagesize($_FILES['photo']['tmp_name']);
           $largeur = $taille[0];
           $hauteur = $taille[1];
           $largeur_miniature = 700;
           $hauteur_miniature = $hauteur / $largeur * 700;
           $im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
           $im_miniature = imagecreatetruecolor($largeur_miniature
           , $hauteur_miniature);
           imagecopyresampled($im_miniature, $im, 0, 0, 0, 0, $largeur_miniature, $hauteur_miniature, $largeur, $hauteur);
           rename($_FILES["name"],$id);
           imagejpeg($im_miniature, 'img/'.$_FILES['photo']['name'], 90);
           echo '<img src="img/' . $_FILES['photo']['name'] . '">';
       }
       ?>
   </body>
</html>
