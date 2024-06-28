<?php
$meta['description'] = "Ma page de contact";
const TITLE = 'Contact';

if (file_exists('./include/header.php')) {  // verifie l'existance du header
    include './include/header.php';  // inclue le header
} else {
    echo "Erreur : introuvable.";
} ?>

<main class="contact-main">
    <div class="title-page">
        <h1><?php echo TITLE ?></h1>
    </div>

    <?php
    session_start();

    $errors = []; // stock les message erreure

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // envoi du formulaire
        // récupére les valeurs des champs 
        $civilite = $_POST["civilite"];
        $nom = trim($_POST["nom"]);
        $prenom = trim($_POST["prenom"]);
        $email = trim($_POST["email"]);
        $contact = $_POST["contact"];
        $message = trim($_POST["message"]);
        


        $regex = "/^[a-zA-Z-' ]*$/";
        if (strlen($message) < 5  || empty($message)) {  // strlean verifie que la taille dune chaine de caractére et empty si il nest pas vide
            $errors['message'] = "Le message ne peut pas etre vide et doit contenir au moins 5 caractères.";
        } elseif (!preg_match($regex, $message)) {
            $errors['message'] = "le champs peut contenir que des lettres et des espaces.";
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
        } elseif (!preg_match($regex, $nom)) {
            $errors['nom'] = "le champs peut contenir que des lettres et des espaces.";
        }

        if (empty($prenom)) {  // le prénom soit pas vide 
            $errors['prenom'] = "Le champ prénom ne peut pas etre vide";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $prenom)) {
            $errors['prenom'] = "le champs peut contenir que des lettres et des espaces.";
        }

        if (empty($civilite)) {  // le prénom soit pas vide 
            $errors['civilite'] = "Le champ civilité ne peut pas etre vide";
        }
        if (empty($_FILES['userfile']['name'])) {
            $errors['file'] = "Veuillez sélectionner un fichier à télécharger.";
        } else {

            $uploaddir = './image/uploads/';
            $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

            if ($_FILES['userfile']['size'] > 30000) {
                $errors['file'] = "Le fichier est trop grand.";
            }

            $allowedTypes = array("jpg", "png", "jpeg", "gif");
            $fileType = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));
            if (!in_array($fileType, $allowedTypes)) {
                $errors['file'] = "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
            }

            if (empty($errors)) {
                if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                    $errors['file'] = "Erreur lors du téléchargement du fichier.";
                }
               
               

                //var_dump($_FILES);
            }
           
        }
        if (!empty($errors)) {  // stocké les valeur des champs si il y a des erreur
            $_SESSION["nom"] = $nom;
            $_SESSION["prenom"] = $prenom;
            $_SESSION["email"] = $email;
            $_SESSION["message"] = $message;
           
        } else {
            // suprime les valeur stocké si pas d'erreur 
            unset($_SESSION["nom"], $_SESSION["prenom"], $_SESSION["email"], $_SESSION["message"]);
        }

        if (empty($errors)) {  // si il y a pas d'erreure

            // stock les réponse de l'utilisateur dans une variable
            $data = "\n" . "\n" . " - " . "civilité : " . $civilite . "\n" . " - " . "nom : " . $nom . "\n" . " - " . "prenom : " . $prenom . "\n" . " - " . "email : " . $email . "\n" . " - " . "Raison du contact : " . $contact . "\n" . " - " . "message : " . $message . "\n" . "\n" . "- - - - - - - - - - - - - - - - - - - -  ";

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

    <form action="index.php?page=contact" method="post" enctype="multipart/form-data">
        <label for="civilite">Civilité : </label>
        <select name="civilite">
            <option value="">Choisir...</option>
            <option value="Monsieur" <?php if (isset($civilite) && $civilite == "Monsieur"); ?>>Monsieur</option>
            <option value="Madame" <?php if (isset($civilite) && $civilite == "Madame"); ?>>Madame</option>
            <option value="Mademoiselle" <?php if (isset($civilite) && $civilite == "Mademoiselle"); ?>>Mademoiselle</option>
        </select>
        <?php if (isset($errors['civilite'])) : ?>
            <div class="error"><?php echo $errors['civilite']; ?></div>
        <?php endif; ?>

        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($_SESSION["nom"] ?? ''); ?>">
        <?php if (isset($errors['nom'])) : ?>
            <div class="error"><?php echo $errors['nom']; ?></div>
        <?php endif; ?>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" value="<?php echo htmlspecialchars($_SESSION["prenom"] ?? ''); ?>">
        <?php if (isset($errors['prenom'])) : ?>
            <div class="error"><?php echo $errors['prenom']; ?></div>
        <?php endif; ?>

        <label for="email">Email :</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION["email"] ?? ''); ?>">
        <?php if (isset($errors['email'])) : ?>
            <div class="error"><?php echo $errors['email']; ?></div>
        <?php endif; ?>

        <label>Raison du contact :</label><br>
        <input type="radio" name="contact" value="Web" <?php if (isset($contact) && $contact == "Web") echo 'checked'; ?>>
        <label for="Web">Web</label><br>
        <input type="radio" name="contact" value="Mobile" <?php if (isset($contact) && $contact == "Wobile") echo 'checked'; ?>>
        <label for="Mobile">Mobile</label><br>
        <input type="radio" name="contact" value="Gameboy" <?php if (isset($contact) && $contact == "Gameboy") echo 'checked'; ?>>
        <label for="Gameboy">Gameboy</label><br>
        <?php if (isset($errors['contact'])) : ?>
            <div class="error"><?php echo $errors['contact']; ?></div>
        <?php endif; ?>


        <label for="message">Message :</label>
        <textarea name="message"><?php echo htmlspecialchars($_SESSION["message"] ?? ''); ?></textarea>

        <?php if (isset($errors['message'])) : ?>
            <div class="error"><?php echo $errors['message']; ?></div>
        <?php endif; ?>


        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
        Envoyez ce fichier : <input name="userfile" type="file" value="<?php echo htmlspecialchars($_SESSION["userfile"] ?? ''); ?>" />
        <?php if (isset($errors['file'])) : ?>
            <div class="error"><?php echo $errors['file']; ?></div>
        <?php endif; ?>

        <input type="submit" value="Envoyer">
    </form>


</main>


<?php
session_destroy();
if (file_exists('./include/footer.php')) {
    include './include/footer.php';
} else {
    echo "Erreur : introuvable.";
}
?>