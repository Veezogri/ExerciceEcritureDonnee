<?php
require_once 'header.php';
?>

<section class="max-w-6xl mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold text-center text-blue-700 mb-4">Bienvenue sur le CRM Hôpital Saint Gilles</h1>
  <p class="text-center text-gray-600 mb-10">Gérez facilement les patients et les rendez-vous depuis cet espace.</p>

  <div class="bg-white p-6 rounded-md shadow mb-10">
    <h2 class="text-xl font-semibold mb-4">Rechercher un patient</h2>
    <?php require_once 'searchpatient.php'; ?>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6 text-center">
      <i class="fas fa-user-injured text-3xl text-blue-600 mb-4"></i>
      <h3 class="text-lg font-semibold">Liste des patients</h3>
      <p class="text-sm text-gray-600">Voir et gérer tous les patients enregistrés.</p>
      <a href="liste-patient.php" class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Accéder</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6 text-center">
      <i class="fas fa-user-plus text-3xl text-green-600 mb-4"></i>
      <h3 class="text-lg font-semibold">Ajouter un patient</h3>
      <p class="text-sm text-gray-600">Enregistrer un nouveau patient dans la base.</p>
      <a href="ajout-patient.php" class="inline-block mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Ajouter</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6 text-center">
      <i class="fas fa-calendar-check text-3xl text-purple-600 mb-4"></i>
      <h3 class="text-lg font-semibold">Rendez-vous</h3>
      <p class="text-sm text-gray-600">Voir les rendez-vous planifiés.</p>
      <a href="liste-rdv.php" class="inline-block mt-4 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Voir les RDV</a>
    </div>
  </div>
</section>

<?php
require_once 'footer.php';
?>