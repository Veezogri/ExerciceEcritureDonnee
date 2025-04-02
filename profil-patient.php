<?php
require_once 'db.php';
require_once 'header.php';
require_once 'footer.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p>Identifiant du patient manquant.</p>";
    exit;
}

$id = $_GET['id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];

    $sqlUpdate = "UPDATE patients SET lastname = :lastname, firstname = :firstname, birthdate = :birthdate, phone = :phone, mail = :mail WHERE id = :id";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->execute([
        ':lastname' => $lastname,
        ':firstname' => $firstname,
        ':birthdate' => $birthdate,
        ':phone' => $phone,
        ':mail' => $mail,
        ':id' => $id
    ]);

    echo "<p style='color: green;'>Profil mis à jour avec succès.</p>";
}

$sql = 'SELECT * FROM patients WHERE id = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$patient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$patient) {
    echo '<p>Patient non trouvé.</p>';
    exit;
}
?>

<h1>Profil du patient</h1>

<form method="POST" id="profilForm">
    <label>Nom : <input type="text" name="lastname" value="<?= htmlspecialchars($patient['lastname']) ?>" readonly></label><br>
    <label>Prénom : <input type="text" name="firstname" value="<?= htmlspecialchars($patient['firstname']) ?>" readonly></label><br>
    <label>Date de naissance : <input type="date" name="birthdate" value="<?= htmlspecialchars($patient['birthdate']) ?>" readonly></label><br>
    <label>Téléphone : <input type="text" name="phone" value="<?= htmlspecialchars($patient['phone']) ?>" readonly></label><br>
    <label>Email : <input type="email" name="mail" value="<?= htmlspecialchars($patient['mail']) ?>" readonly></label><br><br>
    <button type="submit" id="saveBtn" style="display:none;">💾 Enregistrer</button>
</form>

<button onclick="enableEdit()">✏️ Modifier le profil</button>
<br><br>
<a href="liste-patient.php">&larr; Retour à la liste</a>

<script>
function enableEdit() {
    const form = document.getElementById('profilForm');
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => input.removeAttribute('readonly'));
    document.getElementById('saveBtn').style.display = 'inline-block';
}
</script>

<!-- afficher les rendez-vous du patient -->
<h2>Rendez-vous du patient</h2>
<?php
$sql = 'SELECT * FROM appointments WHERE idPatients = :id ORDER BY dateHour ASC';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$rdvs = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($rdvs) > 0 ){
    foreach($rdvs as $rdv){
        echo '<p>Date : ' . htmlspecialchars($rdv['dateHour']) . '</p>';
        echo '<p><a href="rendezvous.php?id=' . $rdv['id'] . '">Voir</a></p>';
    }
}
else {
    echo '<p>Aucun rendez-vous trouvé pour ce patient.</p>';
}

// fonction pour supprimer un patient et ses rendez-vous

function deletePatient($id, $conn){
    // Supprimer le patient
    $sqlDeletePatient = 'DELETE FROM patients WHERE id =:id';
    $stmtDeletePatient = $conn -> prepare($sqlDeletePatient);
    $stmtDeletePatient -> bindParam(':id', $id);
    $stmtDeletePatient -> execute();

    // Supprimer les rdv assiociés

    $sqlDeleteRdv2 = 'DELETE FROM appointments WHERE idPatients = :id';
    $stmtDeleteRdv2 = $conn -> prepare($sqlDeleteRdv2);
    $stmtDeleteRdv2 -> bindParam(':id', $id);
    $stmtDeleteRdv2 -> execute();

}

if (isset($_GET['action']) && $_GET['action'] === 'delete2') {
    $id = $_GET['id'];
    deletePatient($id, $conn);
    header('Location: liste-patient.php');
    exit;
}
$conn = null;
?>

