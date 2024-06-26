<?php 
$meta['description'] = "Ma page de hobby";
$title = 'contact'; 

if (file_exists('./include/header.php')) {
    include './include/header.php';
} else {
    echo "Erreur : Fichier header.php introuvable.";
} ?>

<main>
    <div class="title-page"><h1>Contact</h1></div>

<div class="container">
<?php 
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $civilite = $_POST["civilite"];
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $email = trim($_POST["email"]);
    $raison_contact = $_POST["raison_contact"];
    $message = trim($_POST["message"]);

    if (strlen($message) < 5) {
        $errors[] = "Le message doit contenir au moins 5 caractères.";
    }

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse email n'est pas valide.";
    }

  
    $valid_reasons = ["Service Comptable", "Autre Raison"];
    if (!in_array($raison_contact, $valid_reasons)) {
        $errors[] = "Veuillez choisir une raison de contact valide.";
    }
    if (empty($nom)) {
        $errors[] = "Le champ nom est requis.";
    }
    if (empty($prenom)) {
        $errors[] = "Le champ prénom est requis.";
    }


    
}
if (empty($errors)) {
   
    $person_data = $civilite . " " . $nom . " " . $prenom . " - " . $email . " - " . $raison_contact . " - " . $message . "\n";
    
    
    $file = 'contact.txt';

   
    $current = file_get_contents($file);

   
    $current .= $person_data;

    
    file_put_contents($file, $current);

   
    echo "Formulaire soumis avec succès et les données ont été enregistrées dans people.txt !";
}

  ?>
<form action="" method="post">
    <label for="civilite">Civilité :</label>
    <select id="civilite" name="civilite" >
        <option value="">Choisir...</option>
        <option value="Monsieur">Monsieur</option>
        <option value="Madame">Madame</option>
        <option value="Mademoiselle">Mademoiselle</option>
    </select>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" >

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" >
    
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" >

    <label>Raison du contact :</label><br>
    <input type="radio" id="service_comptable" name="raison_contact" value="Service Comptable" >
    <label for="service_comptable">Service Comptable</label><br>
    <input type="radio" id="autre_raison" name="raison_contact" value="Autre Raison">
    <label for="autre_raison">Autre Raison</label><br>
    

    <label for="message">Message :</label>
    <textarea id="message" name="message" ></textarea>

    <input type="submit" value="Envoyer">
</form>
<?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

</div>

</main>


<?php if (file_exists('./include/footer.php')) {
    include './include/footer.php';
} else {
    echo "Erreur : Fichier footer.php introuvable.";
}
?>