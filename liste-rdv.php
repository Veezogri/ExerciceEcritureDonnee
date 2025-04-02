<!-- page qui affiche la liste des rendez-vous -->
<?php
require_once 'db.php';
require_once 'header.php';


$sql = 'SELECT a.id AS id, p.id AS patientId, a.dateHour, p.lastname, p.firstname FROM appointments AS a INNER JOIN patients AS p ON a.idPatients = p.id ORDER BY datehour ASC';
$stmt = $conn->prepare($sql);
$stmt->execute();
$rdvs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="max-w-6xl mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">Liste des rendez-vous</h1>

  <?php if (count($rdvs) > 0): ?>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white shadow-md rounded-md overflow-hidden">
        <thead class="bg-blue-100">
          <tr>
            <th class="px-4 py-3 text-left">Date et heure</th>
            <th class="px-4 py-3 text-left">Patient</th>
            <th class="px-4 py-3 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rdvs as $rdv): ?>
            <tr class="border-t hover:bg-gray-50">
              <td class="px-4 py-2 text-gray-800">
                <?= date('d/m/Y H:i', strtotime($rdv['dateHour'])) ?>
              </td>
              <td class="px-4 py-2 text-gray-700">
                <?= htmlspecialchars($rdv['firstname']) . ' ' . htmlspecialchars($rdv['lastname']) ?>
              </td>
              <td class="px-4 py-2 space-x-2">
                <a href="rendezvous.php?id=<?= $rdv['id'] ?>" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                  <i class="fas fa-eye"></i> Voir
                </a>
                <a href="rendezvous.php?id=<?= $rdv['id'] ?>&action=delete" class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                  <i class="fas fa-trash"></i> Supprimer
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded mt-4 text-center">
      Aucun rendez-vous planifié pour le moment.
    </div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>