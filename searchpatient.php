<?php
require_once 'db.php';
require_once 'header.php';


// Ajout chanmp de recherche pour les patients

echo '<form method="GET" action="">';
echo '<input type="text" name="search" placeholder="Rechercher un patient...">';
echo '<input type="submit" value="Rechercher">';
echo '</form>';

if (isset($_GET['search'])){
    $search = '%' . $_GET['search'] . '%';
    $search = htmlspecialchars($search);
    $sql = 'SELECT * FROM patients WHERE lastname like :search Or firstname like :search';
    $stmt2 = $conn ->prepare($sql);
    $stmt2 -> bindParam(':search', $search);
    $stmt2 -> execute();
    $patients = $stmt2 -> fetchAll(PDO::FETCH_ASSOC);

    if(count($patients) > 0){
        echo '<h2>Résultats de la recherche :</h2>';
        echo '<ul>';
        foreach ($patients as $patient) {
            echo '<li>' . htmlspecialchars($patient['firstname']) . ' ' . htmlspecialchars($patient['lastname']) . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Aucun patient trouvé.</p>';
    }

    

    
}


$conn = null;
?>