<?php
require_once 'db.php';
require_once 'header.php';

$sql = 'SELECT * FROM patients ORDER BY lastname ASC';
$stmt = $conn->prepare($sql);
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

function sanitize($str): string {
  return htmlspecialchars(trim(stripslashes($str)));
}

if (isset($_POST['dateHour']) && isset($_POST['id_patient'])) {
  $date_rdv = sanitize($_POST['dateHour']);
  $id_patient = (int) $_POST['id_patient'];

  $sql = 'INSERT INTO appointments (dateHour, idPatients) VALUES (:date_rdv, :id_patient)';
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':date_rdv', $date_rdv);
  $stmt->bindParam(':id_patient', $id_patient);
  $stmt->execute();

  echo "<div class='bg-green-100 text-green-800 px-4 py-3 rounded mt-6 max-w-xl mx-auto text-center'>Rendez-vous ajouté avec succès.</div>";
  echo "<div class='text-center mt-4'><a href='liste-rdv.php' class='text-blue-600 hover:underline'>Voir la liste des rendez-vous</a></div>";
  include 'footer.php';
  exit;
}
?>

<div class="max-w-xl mx-auto px-4 py-10 bg-white shadow-md rounded-md">
  <h1 class="text-2xl font-bold text-center text-blue-700 mb-6">Ajouter un rendez-vous</h1>

  <form method="post" class="space-y-6">
    <div>
      <label for="dateHour" class="block font-semibold mb-1">Date :</label>
      <input type="date" id="dateHour" name="dateHour"
             class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
    </div>

    <div>
      <label for="id_patient" class="block font-semibold mb-1">Patient :</label>
      <select name="id_patient" id="id_patient"
              class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
        <option value="">Sélectionner un patient</option>
        <?php foreach ($patients as $patient): ?>
          <option value="<?= $patient['id'] ?>">
            <?= htmlspecialchars($patient['lastname'] . ' ' . $patient['firstname']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md">
      Ajouter le rendez-vous
    </button>
  </form>
</div>

<?php require_once 'footer.php'; ?>