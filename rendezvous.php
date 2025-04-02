<?php
require_once 'db.php';
require_once 'header.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo "<div class='text-center text-red-600 font-semibold mt-6'>Identifiant du rendez-vous manquant.</div>";
  include 'footer.php';
  exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $dateHour = $_POST['dateHour'];

  $sqlUpdate = "UPDATE appointments SET dateHour = :dateHour WHERE id = :id";
  $stmtUpdate = $conn->prepare($sqlUpdate);
  $stmtUpdate->execute([
    ':dateHour' => $dateHour,
    ':id' => $id
  ]);

  echo "<div class='bg-green-100 text-green-800 px-4 py-3 rounded mt-6 max-w-xl mx-auto text-center'>Rendez-vous mis à jour avec succès.</div>";
}

$sql = 'SELECT * FROM appointments INNER JOIN patients ON appointments.idPatients = patients.id WHERE appointments.id = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$rdv = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$rdv) {
  echo "<div class='text-center text-red-600 font-semibold mt-6'>Rendez-vous non trouvé.</div>";
  include 'footer.php';
  exit;
}
?>

<div class="max-w-xl mx-auto px-4 py-10 bg-white shadow-md rounded-md">
  <h1 class="text-2xl font-bold text-center text-blue-700 mb-6">Modifier un rendez-vous</h1>

  <form method="POST" id="rdvForm" class="space-y-4">
    <div>
      <label class="block font-semibold mb-1">Date :</label>
      <input type="datetime-local" name="dateHour" value="<?= htmlspecialchars($rdv['dateHour']) ?>" readonly
             class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100">
    </div>
    <div>
      <label class="block font-semibold mb-1">Nom :</label>
      <input type="text" name="lastname" value="<?= htmlspecialchars($rdv['lastname']) ?>" readonly
             class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100">
    </div>
    <div>
      <label class="block font-semibold mb-1">Prénom :</label>
      <input type="text" name="firstname" value="<?= htmlspecialchars($rdv['firstname']) ?>" readonly
             class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100">
    </div>

    <button type="submit" id="saveBtn"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded hidden">
      💾 Enregistrer
    </button>
  </form>

  <div class="mt-6 flex justify-between">
    <button onclick="enableEdit()"
            class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded">
      ✏️ Modifier le RDV
    </button>

    <a href="?id=<?= $id ?>&action=delete"
       class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
      🗑 Supprimer
    </a>
  </div>

  <div class="text-center mt-6">
    <a href="liste-rdv.php" class="text-blue-600 hover:underline">&larr; Retour à la liste</a>
  </div>
</div>

<script>
function enableEdit() {
  const form = document.getElementById('rdvForm');
  const inputs = form.querySelectorAll('input');
  inputs.forEach(input => input.removeAttribute('readonly'));
  document.getElementById('saveBtn').classList.remove('hidden');
}
</script>

<?php
function deleteRendezVous($id, $conn) {
  $sqlDelete = 'DELETE FROM appointments WHERE id = :id';
  $stmtDelete = $conn->prepare($sqlDelete);
  $stmtDelete->bindParam(':id', $id);
  $stmtDelete->execute();
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
  deleteRendezVous($id, $conn);
  header('Location: liste-rdv.php');
  exit;
}

include 'footer.php';
?>