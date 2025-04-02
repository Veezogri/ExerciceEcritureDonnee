    <?php
    require_once 'header.php';
    ?>

    <div id="search-container">
        <h2>Rechercher vos patients</h2>
        <?php require_once 'searchpatient.php'; ?>

    </div>


<div class="dashboard">
  <div class="card">
    <i class="fas fa-user-injured"></i>
    <h3>Liste des patients</h3>
    <p>Voir et gérer tous les patients enregistrés.</p>
    <a href="liste-patient.php">Accéder</a>
  </div>

  <div class="card">
    <i class="fas fa-user-plus"></i>
    <h3>Ajouter un patient</h3>
    <p>Enregistrer un nouveau patient dans la base.</p>
    <a href="ajout-patient.php">Ajouter</a>
  </div>

  <div class="card">
    <i class="fas fa-calendar-check"></i>
    <h3>Rendez-vous</h3>
    <p>Voir les rendez-vous planifiés.</p>
    <a href="liste-rdv.php">Voir les RDV</a>
  </div>







    <?php
    require_once 'footer.php';
    ?>