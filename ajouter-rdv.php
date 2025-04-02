<?php
require_once 'db.php';
require_once 'header.php';
$sql = 'SELECT * FROM patients ORDER BY lastname ASC';
$stmt = $conn->prepare($sql);
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// function sanitize
function sanitize($str): string {
    return htmlspecialchars(trim(stripslashes($str)));
}

if (isset($_POST['dateHour']) && isset($_POST['id_patient'])) {
    $date_rdv = sanitize($_POST['dateHour']);
    $id_patient = (int) $_POST['id_patient'];

    // Insérer dans la table appointments
    $sql = 'INSERT INTO appointments (dateHour, idPatients) VALUES (:date_rdv, :id_patient)';

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':date_rdv', $date_rdv);
    $stmt->bindParam(':id_patient', $id_patient);
    $stmt->execute();

    echo "<p style='color: green;'>Rendez-vous ajouté avec succès.</p>";
    echo "<p><a href='liste-rdv.php'>Voir la liste des rendez-vous</a></p>";
    exit;
}
?>
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <label for="date">Date :</label><br>
    <input type="date" id="dateHour" name="dateHour"><br><br>

    <label for="id_patient">Patient :</label><br>
    <select name="id_patient" id="id_patient">
        <option value="">Sélectionner un patient</option>
        <?php foreach ($patients as $patient): ?>
            <option value="<?= $patient['id'] ?>">
                <?= htmlspecialchars($patient['lastname'] . ' ' . $patient['firstname']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Ajouter rdv">
</form>
