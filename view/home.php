<?php
$meta['description'] = "Ma page d/'accueil";
$title = 'Accueil';

if (file_exists('./include/header.php')) {
    include './include/header.php';
} else {
    echo "Erreur : introuvable.";
}

?>

<main>
    <div class="title-page">
        <h1><?php echo $title ?></h1>
    </div>
    



</main>

<?php
if (file_exists('./include/footer.php')) {
    include './include/footer.php';
} else {
    echo "Erreur :introuvable.";
}
?>