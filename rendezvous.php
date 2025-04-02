<!-- page qui permet d'afficher les info d'un rdv -->
<?php
require_once 'db.php';
require_once 'header.php';

if (!isset($_GET['id'])|| empty($_GET['id'])){
    echo "<p>Identifiant du rendez-vous manquant.</p>";
    exit;
}

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dateHour = $_POST['dateHour'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];

    $sqlUpdate = "UPDATE appointments SET dateHour = :dateHour WHERE id = :id";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->execute([
        ':dateHour' => $dateHour,
        ':id' => $id
    ]);


   
    
}

$sql = 'SELECT * FROM appointments INNER JOIN patients ON appointments.idPatients = patients.id WHERE appointments.id = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$rdv = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$rdv) {
    echo '<p>Rendez-vous non trouvé.</p>';
    exit;
}
?>
<h1>Rendez-vous</h1>
<form method="POST" id="rdvForm">
    <label>Date : <input type="datetime-local" name="dateHour" value="<?= htmlspecialchars($rdv['dateHour']) ?>" readonly></label><br>
    <label>Nom : <input type="text" name="lastname" value="<?= htmlspecialchars($rdv['lastname']) ?>" readonly></label><br>
    <label>Prénom : <input type="text" name="firstname" value="<?= htmlspecialchars($rdv['firstname']) ?>" readonly></label><br><br>
    <button type="submit" id="saveBtn" style="display:none;">💾 Enregistrer</button>

</form>

<button onclick="enableEdit()">✏️ Modifier le rdv</button>



<script>
function enableEdit() {
    const form = document.getElementById('rdvForm');
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => input.removeAttribute('readonly'));
    document.getElementById('saveBtn').style.display = 'inline-block';
}
</script>
<a href="liste-rdv.php">&larr; Retour à la liste</a>

<!-- supprimer un rendez-vous -->
<?php
function deleteRendezVous($id, $conn) {
    $sqlDelete = 'DELETE FROM appointments WHERE id = :id';
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bindParam(':id', $id);
    $stmtDelete->execute();
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];
    deleteRendezVous($id, $conn);
    header('Location: liste-rdv.php');
    exit;
}

$conn = null;

?>