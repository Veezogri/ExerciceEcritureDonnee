<!-- page qui affiche la liste des patients -->
<?php
require_once 'db.php';
require_once 'header.php';

echo '<h1>Liste des patients</h1>';

// faire pagination et donc là je vais défnir le nombre de patients par page
$patientsPerPage = 10; 
$pageactuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($pageactuelle - 1) * $patientsPerPage;



// là je vais faire une requête pour récupérer le nombre total de patients
$sqlCount = 'SELECT COUNT(*) as total FROM patients';
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->execute();
$totalPatients = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];

// calcule le nombre total de pages qu'il faut pour afficher tous les patients
$totalPages = ceil($totalPatients / $patientsPerPage);


// là je vais faire une requête pour récupérer les patients avec la pagination

$sqlPatients = 'SELECT * FROM patients LIMIT :offset, :limit';
$stmtPatients = $conn->prepare($sqlPatients);
$stmtPatients->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmtPatients->bindParam(':limit', $patientsPerPage, PDO::PARAM_INT);
$stmtPatients->execute();
$patients = $stmtPatients->fetchAll(PDO::FETCH_ASSOC);





if(count($patients) > 0){
    echo '<table>';
    echo '<tr>';
    echo '<th>Nom</th>';
    echo '<th>Prénom</th>';
    echo '<th>Date de naissance</th>';
    echo '<th>Téléphone</th>';
    echo '<th>Email</th>';
    echo '</tr>';

    foreach($patients as $patient){

        echo '<tr>';
        echo '<td>' . $patient['lastname'] . '</td>';
        echo '<td>' . $patient['firstname'] . '</td>';
        echo '<td>' . $patient['birthdate'] . '</td>';
        echo '<td>' . $patient['phone'] . '</td>';
        echo '<td>' . $patient['mail'] . '</td>';
        echo '<td><a href="profil-patient.php?id=' . $patient['id'] . '">Voir profil</a></td>';
        echo '<td><a href="profil-patient.php?id=' . $patient['id'] . '&action=delete2">Supprimer</a></td>';

        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'Aucun patient trouvé.';

}


echo '<div class="pagination">';
if ($pageactuelle > 1) {
    echo '<a href="?page=' . ($pageactuelle - 1) . '">Précédent</a> ';
}
for ($i = 1; $i <= $totalPages; $i++) {
    if ($i == $pageactuelle) {
        echo '<strong>' . $i . '</strong> ';
    } else {
        echo '<a href="?page=' . $i . '">' . $i . '</a> ';
    }
}
if ($pageactuelle < $totalPages) {
    echo '<a href="?page=' . ($pageactuelle + 1) . '">Suivant</a>';
}
echo '</div>';




$conn = null;
?>

