<?php 
$meta['description'] = "Ma page de contact";
$title = 'contact'; 

if (file_exists('./include/header.php')) {  // verifie l'existance du header
    include './include/header.php';  // inclue le header
} else {
    echo "Erreur : Fichier header.php introuvable.";
} ?>

<main>
    <div class="title-page"><h1>Contact</h1></div>

<div class="container">
<?php 
$errors = []; // stock les message erreure

if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        // récupére les valeurs des champs 
    $civilite = $_POST["civilite"]; 
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $email = trim($_POST["email"]);
    $contact = $_POST["raison_contact"];
    $message = trim($_POST["message"]);

    if (strlen($message) < 5) {  // strlean verifie que la taille du message 
        $errors[] = "Le message doit contenir au moins 5 caractères.";
    }

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  // filte la  variable avec le filtre qui verifie les email
        $errors[] = "L'adresse email n'est pas valide.";
    }

  
    $valid = ["Service Comptable", "Autre Raison"]; // les réponse valide
    if (!in_array($contact, $valid)) {  // verifie les chzamps avec les reponse valide
        $errors[] = "Veuillez choisir une raison de contact valide.";
    }

    if (empty($nom)) {  // le nom soit pas vide 
        $errors[] = "Le champ nom est requis.";
    }

    if (empty($prenom)) {  // le prénom soit pas vide 
        $errors[] = "Le champ prénom est requis.";
    }


    
}
if (empty($errors)) {  // si il y a pas d'erreure
   
    // stock les réponse de l'utilisateur dans une variable
    $data = "\n" ." - " ."civilité :" . $civilite ."\n" . " - " . "nom :" . $nom ."\n" . " - " . "prenom :" . $prenom ."\n" . " - " . "email :" . $email ."\n" . " - " ."Raison du contact :" . $contact ."\n" . " - " . "message :" . $message . "\n" . "- - - - - - - - - - - - - - - - - - - -  " ;
    
    // le fichier ou sont stocké ces donné
    $file = './view/contact.txt';

   // recupére le fichier et ces donné
    $current = file_get_contents($file);

   // le fichier + ces nouvelle donné
     $current.= $data;

    // inscrit dans le fichier les donné // FILE_APPEND  : ecrase pas les donné
    file_put_contents($file, $data, FILE_APPEND);

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