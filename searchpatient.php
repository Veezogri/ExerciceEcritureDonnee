<?php
require_once 'db.php';

?>
<form method="GET" action="" class="flex items-center justify-center gap-2 mb-6">
  <input type="text" name="search" placeholder="Rechercher un patient..."
         class="w-full sm:w-80 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
  <button type="submit"
          class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
    <i class="fas fa-search"></i>
  </button>
</form>

<?php
if (isset($_GET['search'])) {
  $search = '%' . $_GET['search'] . '%';
  $search = htmlspecialchars($search);
  $sql = 'SELECT * FROM patients WHERE lastname LIKE :search OR firstname LIKE :search';
  $stmt2 = $conn->prepare($sql);
  $stmt2->bindParam(':search', $search);
  $stmt2->execute();
  $patients = $stmt2->fetchAll(PDO::FETCH_ASSOC);

  echo '<div class="bg-white rounded-md shadow p-4">';
  if (count($patients) > 0) {
    echo '<h2 class="text-lg font-semibold text-blue-700 mb-2">Résultats de la recherche :</h2>';
    echo '<ul class="space-y-1 text-gray-700">';
    foreach ($patients as $patient) {
      echo '<li>- ' . htmlspecialchars($patient['firstname']) . ' ' . htmlspecialchars($patient['lastname']) . '</li>';
    }
    echo '</ul>';
  } else {
    echo '<p class="text-red-600">Aucun patient trouvé.</p>';
  }
  echo '</div>';
}

$conn = null;
?>