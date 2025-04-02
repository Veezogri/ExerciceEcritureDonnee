<?php
require_once 'db.php';
require_once 'header.php';

$pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$pageActuelle = max(1, $pageActuelle);
$patientsParPage = 10;
$offset = ($pageActuelle - 1) * $patientsParPage;

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($search)) {
    $searchParam = '%' . $search . '%';
    $sql = 'SELECT * FROM patients WHERE lastname LIKE :search OR firstname LIKE :search LIMIT :limit OFFSET :offset';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':search', $searchParam);
    $stmt->bindValue(':limit', $patientsParPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $countStmt = $conn->prepare('SELECT COUNT(*) FROM patients WHERE lastname LIKE :search OR firstname LIKE :search');
    $countStmt->bindValue(':search', $searchParam);
    $countStmt->execute();
    $totalPatients = $countStmt->fetchColumn();
} else {
    $sql = 'SELECT * FROM patients LIMIT :limit OFFSET :offset';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':limit', $patientsParPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $countStmt = $conn->query('SELECT COUNT(*) FROM patients');
    $totalPatients = $countStmt->fetchColumn();
}

$totalPages = ceil($totalPatients / $patientsParPage);
?>

<div class="max-w-6xl mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold text-center text-blue-700 mb-6">Liste des patients</h1>

  <form class="flex justify-center mb-6" method="get">
    <input type="text" name="search" placeholder="Rechercher..."
           value="<?= htmlspecialchars($search) ?>"
           class="px-4 py-2 border border-gray-300 rounded-l-md w-64">
    <button type="submit" class="bg-blue-600 text-white px-4 rounded-r-md hover:bg-blue-700">
      <i class="fas fa-search"></i>
    </button>
  </form>

  <?php if (count($patients) > 0): ?>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white shadow-md rounded-md overflow-hidden">
        <thead class="bg-blue-100">
          <tr>
            <th class="px-4 py-3 text-left">Nom</th>
            <th class="px-4 py-3 text-left">Prénom</th>
            <th class="px-4 py-3 text-left">Naissance</th>
            <th class="px-4 py-3 text-left">Téléphone</th>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($patients as $patient): ?>
            <tr class="border-t">
              <td class="px-4 py-2"><?= htmlspecialchars($patient['lastname']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($patient['firstname']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($patient['birthdate']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($patient['phone']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($patient['mail']) ?></td>
              <td class="px-2 py-2">
                <a href="profil-patient.php?id=<?= $patient['id'] ?>"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                  <i class="fas fa-eye"></i> Voir
                </a>
              </td>
              <td class="px-2 py-2">
                <a href="profil-patient.php?id=<?= $patient['id'] ?>&action=delete2"
                   class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                  <i class="fas fa-trash-alt"></i> Supprimer
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="mt-6 flex justify-center space-x-2">
      <?php if ($pageActuelle > 1): ?>
        <a href="?page=<?= $pageActuelle - 1 ?>&search=<?= urlencode($search) ?>"
           class="px-3 py-1 border rounded hover:bg-gray-100">&laquo;</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($i == $pageActuelle): ?>
          <span class="px-3 py-1 border border-blue-500 bg-blue-500 text-white rounded"><?= $i ?></span>
        <?php else: ?>
          <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"
             class="px-3 py-1 border rounded hover:bg-gray-100"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if ($pageActuelle < $totalPages): ?>
        <a href="?page=<?= $pageActuelle + 1 ?>&search=<?= urlencode($search) ?>"
           class="px-3 py-1 border rounded hover:bg-gray-100">&raquo;</a>
      <?php endif; ?>
    </div>

  <?php else: ?>
    <div class="bg-red-100 text-red-800 px-4 py-3 rounded mt-4 text-center">
      Aucun patient trouvé.
    </div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
