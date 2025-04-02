<!-- page qui affiche la liste des rendez-vous -->
<?php
require_once 'db.php';
require_once 'header.php';

echo '<h1>Liste des rendez-vous</h1>';
$sql = 'SELECT a.id AS id, p.id AS patientId, a.dateHour, p.lastname, p.firstname FROM appointments AS a INNER JOIN patients AS p ON a.idPatients = p.id ORDER BY datehour ASC';
$stmt = $conn->prepare($sql);
$stmt->execute();
$rdvs = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($rdvs) > 0){
    echo '<table>';
    echo '<tr>';
    echo '<th>Date</th>';
    echo '<th>Nom</th>';
    echo '<th>Prénom</th>';
    echo '</tr>';

    foreach($rdvs as $rdv){
        echo '<tr>';
        echo '<td>' . $rdv['dateHour'] . '</td>';
        echo '<td>' . $rdv['lastname'] . '</td>';
        echo '<td>' . $rdv['firstname'] . '</td>';
        echo '<td><a class="btn" href="rendezvous.php?id=' . $rdv['id'] . '">Voir</a></td>';
        echo '<td><a class="btn btn-danger" href="rendezvous.php?id=' . $rdv['id'] . '&action=delete">Supprimer</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'Aucun rendez-vous trouvé.';
}

$conn = null;
?>
<a href="ajouter-rdv.php">Ajouter un rendez-vous</a>



