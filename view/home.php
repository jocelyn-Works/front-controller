<?php
$meta['description'] = "Ma page d/'accueil";
const TITLE = 'Accueil';

if (file_exists('./include/header.php')) {
    include './include/header.php';
    } else {
        echo "Erreur : introuvable.";
    }

?>

<main class="main-home">
    <div class="title-page">
        <h1><?php echo TITLE ?></h1>
    </div>

    <div class="container-cofe">
    <div class="coffee-header">
      <div class="coffee-header__buttons coffee-header__button-one"></div>
      <div class="coffee-header__buttons coffee-header__button-two"></div>
      <div class="coffee-header__display"></div>
      <div class="coffee-header__details"></div>
    </div>
    <div class="coffee-medium">
      <div class="coffe-medium__exit"></div>
      <div class="coffee-medium__arm"></div>
      <div class="coffee-medium__liquid"></div>
      <div class="coffee-medium__smoke coffee-medium__smoke-one"></div>
      <div class="coffee-medium__smoke coffee-medium__smoke-two"></div>
      <div class="coffee-medium__smoke coffee-medium__smoke-three"></div>
      <div class="coffee-medium__smoke coffee-medium__smoke-for"></div>
      <div class="coffee-medium__cup"></div>
    </div>
    <div class="coffee-footer"></div>
  </div>
   
    



</main>

<?php
if (file_exists('./include/footer.php')) {
    include './include/footer.php';
    } else {
        echo "Erreur :introuvable.";
    }
?>