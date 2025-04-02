<?php // header.php ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hôpital Saint Gilles</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800">

  <header class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
      <div class="flex items-center gap-3">
        <i class="fas fa-hospital-symbol text-2xl text-blue-600"></i>
        <h1 class="text-xl sm:text-2xl font-bold text-blue-700">Hôpital Saint Gilles</h1>
      </div>
      <nav class="flex gap-4 text-sm font-medium">
        <a href="index.php" class="text-gray-700 hover:text-blue-600 flex items-center gap-1">
          <i class="fas fa-home"></i> Accueil
        </a>
        <a href="liste-patient.php" class="text-gray-700 hover:text-blue-600 flex items-center gap-1">
          <i class="fas fa-user-injured"></i> Patients
        </a>
        <a href="liste-rdv.php" class="text-gray-700 hover:text-blue-600 flex items-center gap-1">
          <i class="fas fa-calendar-check"></i> Rendez-vous
        </a>
        <a href="ajouter-rdv.php" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
          <i class="fas fa-plus"></i> Nouveau RDV
        </a>
      </nav>
    </div>
  </header>

  <main class="py-8 px-4">