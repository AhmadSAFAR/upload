<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <label for="imageUpload">Upload des images</label> <br>   
        <input type="file" id="files" name="files"   multiple><br><br> 
       <input type="submit" value="Upload" />
    </form>
    
</body>
</html>
<?php
echo"<pre>";
if (!empty( $_FILES['files']['name'][0])){
$dossier = 'uploads/';
$extensions = array('.png', '.gif', '.jpg');
$taille_maxi = 1000000;
$taille = filesize($_FILES['files']['tmp_name']);
$extension = strrchr($_FILES['files']['name'] , '.');
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg';
}
// Check file size 
if($taille > $taille_maxi)
{
     $erreur = 'Le fichier est plus de 1Mo';
}

if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{   
     $FileNewName = uniqid().$extension;
     $destination=$dossier.$FileNewName;
     if(move_uploaded_file($_FILES['files']['tmp_name'],$destination) )
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}

}

?>
<?php
$res=opendir("uploads");
while (($it=readdir($res)) !==false){
     if($it != '.'&& $it!='..') { ?>
 <figure>
    <img src="uploads/<?= $it?>"
         alt="img">
         <figcaption><?= $it?></figcaption>

</figure>
<?php    
}   


}

echo"</pre>";
?>


