<?php
$meta['description'] = "Ma page d/'accueil";
const TITLE = 'Accueil';

if (file_exists('./include/header.php')) {
    include './include/header.php';
    } else {
        echo "Erreur : introuvable.";
    }

?>

<main>
    <div class="title-page">
        <h1><?php echo TITLE ?></h1>
    </div>
   
    



</main>

<?php
if (file_exists('./include/footer.php')) {
    include './include/footer.php';
    } else {
        echo "Erreur :introuvable.";
    }
?>