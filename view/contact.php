<?php
$meta['description'] = "Ma page de contact";
$title = 'Contact';

if (file_exists('./include/header.php')) {  // verifie l'existance du header
    include './include/header.php';  // inclue le header
} else {
    echo "Erreur : introuvable.";
} ?>

<main>
    <div class="title-page">
        <h1><?php echo $title?></h1>
    </div>

    <?php
    session_start();
    
    $errors = []; // stock les message erreure

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // récupére les valeurs des champs 
        $civilite = $_POST["civilite"];
        $nom = trim($_POST["nom"]);
        $prenom = trim($_POST["prenom"]);
        $email = trim($_POST["email"]);
        $contact = $_POST["contact"];
        $message = trim($_POST["message"]);

        if (strlen($message) < 5) {  // strlean verifie que la taille du message 
            $errors['message'] = "Le message doit contenir au moins 5 caractères.";
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  // filte la  variable avec le filtre qui verifie les email
            $errors['email'] = "L'adresse email n'est pas valide.";
        }


        $valid = ["Web", "Mobile", "Gameboy"]; // les réponse valide
        if (!in_array($contact, $valid)) {  // verifie les chzamps avec les reponse valide
            $errors['contact'] = "Veuillez choisir une raison de contact valide.";
        }

        if (empty($nom)) {  // le nom soit pas vide 
            $errors['nom'] = "Le champ nom ne peut pas etre vide";
        }

        if (empty($prenom)) {  // le prénom soit pas vide 
            $errors['prenom'] = "Le champ prénom ne peut pas etre vide";
        }
        if (empty($civilite)) {  // le prénom soit pas vide 
            $errors['civilite'] = "Le champ civilité ne peut pas etre vide";
        }




        if (empty($errors)) {  // si il y a pas d'erreure

            // stock les réponse de l'utilisateur dans une variable
            $data = "\n" . "\n". " - " . "civilité :" . $civilite . "\n" . " - " . "nom :" . $nom . "\n" . " - " . "prenom :" . $prenom . "\n" . " - " . "email :" . $email . "\n" . " - " . "Raison du contact :" . $contact . "\n" . " - " . "message :" . $message . "\n" . "\n". "- - - - - - - - - - - - - - - - - - - -  ";

            // le fichier ou sont stocké ces donné
            $file = './view/contact.txt';

            // recupére le fichier et ces donné
            $current = file_get_contents($file);

            // le fichier + ces nouvelle donné
            $current .= $data;

            // inscrit dans le fichier les donné // FILE_APPEND  : ecrase pas les donné
            file_put_contents($file, $data, FILE_APPEND);
    ?>

            <script>
                Swal.fire({
                    icon: "success",
                    title: "Formulaire envoyer",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
    <?php
        }
    }

    ?>


    <form method="post">
        <label for="civilite">Civilité :</label>
        <select id="civilite" name="civilite">
            <option value="">Choisir...</option>
            <option value="Monsieur" <?php if (isset($civilite) && $civilite == "Monsieur") echo 'selected'; ?>>Monsieur</option>
            <option value="Madame" <?php if (isset($civilite) && $civilite == "Madame") echo 'selected'; ?>>Madame</option>
            <option value="Mademoiselle" <?php if (isset($civilite) && $civilite == "Mademoiselle") echo 'selected'; ?>>Mademoiselle</option>
        </select>
        <?php if (isset($errors['civilite'])) : ?>
            <div class="error"><?php echo $errors['civilite']; ?></div>
        <?php endif; ?>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom">
        <?php if (isset($errors['nom'])) : ?>
            <div class="error"><?php echo $errors['nom']; ?></div>
        <?php endif; ?>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom">
        <?php if (isset($errors['prenom'])) : ?>
            <div class="error"><?php echo $errors['prenom']; ?></div>
        <?php endif; ?>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email">
        <?php if (isset($errors['email'])) : ?>
            <div class="error"><?php echo $errors['email']; ?></div>
        <?php endif; ?>

        <label>Raison du contact :</label><br>
        <input type="radio" id="Web" name="contact" value="Web"<?php if(isset($contact) && $contact == "Web") echo 'checked'; ?>>
        <label for="Web">Web</label><br>
        <input type="radio" id="Mobile" name="contact" value="Mobile"<?php if(isset($contact) && $contact == "Wobile") echo 'checked'; ?>>
        <label for="Mobile">Mobile</label><br>
        <input type="radio" id="Gameboy" name="contact" value="Gameboy"<?php if(isset($contact) && $contact == "Gameboy") echo 'checked'; ?>>
        <label for="Gameboy">Gameboy</label><br>
        <?php if (isset($errors['contact'])) : ?>
            <div class="error"><?php echo $errors['contact']; ?></div>
        <?php endif; ?>


        <label for="message">Message :</label>
        <textarea id="message" name="message"></textarea>
        <?php if (isset($errors['message'])) : ?>
            <div class="error"><?php echo $errors['message']; ?></div>
        <?php endif; ?>

        <input type="submit" value="Envoyer">
    </form>



</main>


<?php if (file_exists('./include/footer.php')) {
    include './include/footer.php';
} else {
    echo "Erreur : introuvable.";
}
?>