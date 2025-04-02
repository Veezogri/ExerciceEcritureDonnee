<!-- fichier où je créer un formulaire pour ajouter un patient -->
<?php
require_once 'db.php';
require_once 'header.php';


// function sanitize
function sanitize( $str): string {
    return htmlspecialchars(trim(stripslashes($str)));
}

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date_naissance']) && isset($_POST['num']) && isset($_POST['mail'])){

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $num = $_POST['num'];
    $mail = $_POST['mail'];



    // je vais sanitizer les données
    $nom = sanitize($nom);
    $prenom = sanitize($prenom);
    $date_naissance = sanitize($date_naissance);
    $num = sanitize($num);
    $mail = sanitize($mail);

    // inserer dans la table patient
    $sql = 'INSERT INTO patients (lastname, firstname, birthdate, phone, mail) VALUES (:nom, :prenom, :date_naissance, :num, :mail)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':num', $num);
    $stmt->bindParam(':mail', $mail);
    $stmt->execute();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AjouterPatient</title>
</head>
<body>
    <h1>Ajouter un patient</h1>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom"><br>
        <label for="prenom">Prénom:</label><br>
        <input type="text" id="prenom" name="prenom"><br>
        <label for="date_naissance">Date de naissance:</label><br>
        <input type="date" id="date_naissance" name="date_naissance"><br>
        <label for="tel">envoie ton num</label><br>
        <input type="text" id="num" name="num"><br>
        <label for="MAIL">donne ton email mon gate</label><br>
        <input type="text" id="mail" name="mail"><br>

        <input type="submit" value="Ajouter Patient">
    </form>
</body>
</html>

<?php
require_once 'footer.php';

?>