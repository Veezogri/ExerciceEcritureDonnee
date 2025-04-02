<?php
require_once 'db.php';
require_once 'header.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo "<div class='text-center text-red-600 font-semibold mt-6'>Identifiant du patient manquant.</div>";
  include 'footer.php';
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

  echo "<div class='bg-green-100 text-green-800 px-4 py-3 rounded mt-6 max-w-xl mx-auto text-center'>Profil mis à jour avec succès.</div>";
}

$sql = 'SELECT * FROM patients WHERE id = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$patient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$patient) {
  echo "<div class='text-center text-red-600 font-semibold mt-6'>Patient non trouvé.</div>";
  include 'footer.php';
  exit;
}
?>

<div class="max-w-2xl mx-auto px-4 py-10 bg-white shadow-md rounded-md">
  <h1 class="text-2xl font-bold text-center text-blue-700 mb-6">Profil du patient</h1>

  <form method="POST" id="profilForm" class="space-y-4">
    <div>
      <label class="block font-semibold mb-1">Nom :</label>
      <input type="text" name="lastname" value="<?= htmlspecialchars($patient['lastname']) ?>" readonly
             class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100">
    </div>
    <div>
      <label class="block font-semibold mb-1">Prénom :</label>
      <input type="text" name="firstname" value="<?= htmlspecialchars($patient['firstname']) ?>" readonly
             class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100">
    </div>
    <div>
      <label class="block font-semibold mb-1">Date de naissance :</label>
      <input type="date" name="birthdate" value="<?= htmlspecialchars($patient['birthdate']) ?>" readonly
             class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100">
    </div>
    <div>
      <label class="block font-semibold mb-1">Téléphone :</label>
      <input type="text" name="phone" value="<?= htmlspecialchars($patient['phone']) ?>" readonly
             class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100">
    </div>
    <div>
      <label class="block font-semibold mb-1">Email :</label>
      <input type="email" name="mail" value="<?= htmlspecialchars($patient['mail']) ?>" readonly
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
      ✏️ Modifier le profil
    </button>

    <a href="profil-patient.php?id=<?= $id ?>&action=delete2"
       class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
      🗑 Supprimer le patient
    </a>
  </div>

  <div class="text-center mt-6">
    <a href="liste-patient.php" class="text-blue-600 hover:underline">&larr; Retour à la liste</a>
  </div>
</div>

<script>
function enableEdit() {
  const form = document.getElementById('profilForm');
  const inputs = form.querySelectorAll('input');
  inputs.forEach(input => input.removeAttribute('readonly'));
  document.getElementById('saveBtn').classList.remove('hidden');
}
</script>

<!-- afficher les rendez-vous du patient -->
<div class="max-w-2xl mx-auto px-4 pt-8">
  <h2 class="text-xl font-bold text-blue-600 mb-4">Rendez-vous du patient</h2>
  <?php
  $sql = 'SELECT * FROM appointments WHERE idPatients = :id ORDER BY dateHour ASC';
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $rdvs = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (count($rdvs) > 0) {
    echo '<ul class="space-y-3">';
    foreach ($rdvs as $rdv) {
      echo '<li class="flex justify-between items-center bg-gray-100 px-4 py-2 rounded">';
      echo '<span class="text-sm text-gray-700">Date : ' . htmlspecialchars($rdv['dateHour']) . '</span>';
      echo '<a href="rendezvous.php?id=' . $rdv['id'] . '" class="text-blue-600 hover:underline text-sm">Voir</a>';
      echo '</li>';
    }
    echo '</ul>';
  } else {
    echo '<p class="text-gray-600">Aucun rendez-vous trouvé pour ce patient.</p>';
  }
  ?>
</div>

<?php
function deletePatient($id, $conn) {
  $sqlDeletePatient = 'DELETE FROM patients WHERE id = :id';
  $stmtDeletePatient = $conn->prepare($sqlDeletePatient);
  $stmtDeletePatient->bindParam(':id', $id);
  $stmtDeletePatient->execute();

  $sqlDeleteRdv2 = 'DELETE FROM appointments WHERE idPatients = :id';
  $stmtDeleteRdv2 = $conn->prepare($sqlDeleteRdv2);
  $stmtDeleteRdv2->bindParam(':id', $id);
  $stmtDeleteRdv2->execute();
}

if (isset($_GET['action']) && $_GET['action'] === 'delete2') {
  deletePatient($id, $conn);
  header('Location: liste-patient.php');
  exit;
}

include 'footer.php';
$conn = null;
?>