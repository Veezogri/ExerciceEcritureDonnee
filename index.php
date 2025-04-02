<?php
require_once 'header.php';
?>

<section class="max-w-7xl mx-auto px-4 py-12">
  <h1 class="text-4xl font-extrabold text-center text-blue-800 mb-4 animate-fade-in">Bienvenue sur le CRM de l'Hôpital Saint Gilles</h1>
  <p class="text-center text-gray-600 text-lg mb-10 animate-fade-in delay-100">Gérez facilement les patients et les rendez-vous depuis cet espace professionnel et moderne.</p>

  <div class="bg-white p-6 rounded-xl shadow-md mb-10 animate-fade-in-up">
    <h2 class="text-2xl font-semibold mb-4">🔍 Rechercher un patient</h2>
    <?php require_once 'searchpatient.php'; ?>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in-up delay-200">
    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-all duration-300">
      <img src="patients.avif" alt="Liste des patients" class="w-full h-40 object-cover rounded-md mb-4">
      <h3 class="text-xl font-semibold text-blue-700">Liste des patients</h3>
      <p class="text-sm text-gray-600">Voir et gérer tous les patients enregistrés.</p>
      <a href="liste-patient.php" class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Accéder</a>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-all duration-300">
      <img src="addpatient2.png" alt="Ajouter un patient" class="w-full h-40 object-cover rounded-md mb-4">
      <h3 class="text-xl font-semibold text-green-600">Ajouter un patient</h3>
      <p class="text-sm text-gray-600">Enregistrer un nouveau patient dans la base.</p>
      <a href="ajout-patient.php" class="inline-block mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Ajouter</a>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-all duration-300">
      <img src="add-patient.png" alt="Rendez-vous" class="w-full h-40 object-cover rounded-md mb-4">
      <h3 class="text-xl font-semibold text-purple-700">Rendez-vous</h3>
      <p class="text-sm text-gray-600">Voir les rendez-vous planifiés.</p>
      <a href="liste-rdv.php" class="inline-block mt-4 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">Voir les RDV</a>
    </div>
  </div>
</section>

<style>
@keyframes fade-in {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes fade-in-up {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
  animation: fade-in 0.8s ease-out both;
}

.animate-fade-in-up {
  animation: fade-in-up 0.8s ease-out both;
}

.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
</style>

<?php
require_once 'footer.php';
?>
