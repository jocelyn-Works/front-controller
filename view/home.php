<?php 
$meta['description'] = "Ma page d/'accueil";
$title = 'Accueil'; 

if (file_exists('./include/header.php')) {
    include './include/header.php';
} else {
    echo "Erreur : Fichier header.php introuvable.";
}

?>

<main>
    <div class="title-page"><h1>Accueil</h1></div>
    
   

</main>

<?php 
if (file_exists('./include/footer.php')) {
    include './include/footer.php';
} else {
    echo "Erreur : Fichier footer.php introuvable.";
}
?>