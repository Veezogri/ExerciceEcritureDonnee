<?php
require_once 'db.php';
require_once 'header.php';

function sanitize($str): string {
  return htmlspecialchars(trim(stripslashes($str)));
}

if (
  isset($_POST['nom']) &&
  isset($_POST['prenom']) &&
  isset($_POST['date_naissance']) &&
  isset($_POST['num']) &&
  isset($_POST['mail'])
) {
  $nom = sanitize($_POST['nom']);
  $prenom = sanitize($_POST['prenom']);
  $date_naissance = sanitize($_POST['date_naissance']);
  $num = sanitize($_POST['num']);
  $mail = sanitize($_POST['mail']);

  $sql = 'INSERT INTO patients (lastname, firstname, birthdate, phone, mail) 
          VALUES (:nom, :prenom, :date_naissance, :num, :mail)';
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':nom', $nom);
  $stmt->bindParam(':prenom', $prenom);
  $stmt->bindParam(':date_naissance', $date_naissance);
  $stmt->bindParam(':num', $num);
  $stmt->bindParam(':mail', $mail);
  $stmt->execute();

  echo "<div class='bg-green-100 text-green-800 px-4 py-3 rounded mt-6 max-w-xl mx-auto text-center'>Patient ajouté avec succès.</div>";
  echo "<div class='text-center mt-4'><a href='liste-patient.php' class='text-blue-600 hover:underline'>Voir la liste des patients</a></div>";
  include 'footer.php';
  exit;
}
?>

<div class="max-w-xl mx-auto px-4 py-10 bg-white shadow-md rounded-md">
  <h1 class="text-2xl font-bold text-center text-blue-700 mb-6">Ajouter un patient</h1>

  <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="space-y-5">
    <div>
      <label for="nom" class="block font-semibold mb-1">Nom :</label>
      <input type="text" id="nom" name="nom" required
             class="w-full px-4 py-2 border border-gray-300 rounded-md">
    </div>

    <div>
      <label for="prenom" class="block font-semibold mb-1">Prénom :</label>
      <input type="text" id="prenom" name="prenom" required
             class="w-full px-4 py-2 border border-gray-300 rounded-md">
    </div>

    <div>
      <label for="date_naissance" class="block font-semibold mb-1">Date de naissance :</label>
      <input type="date" id="date_naissance" name="date_naissance" required
             class="w-full px-4 py-2 border border-gray-300 rounded-md">
    </div>

    <div>
      <label for="num" class="block font-semibold mb-1">Téléphone :</label>
      <input type="text" id="num" name="num" required
             class="w-full px-4 py-2 border border-gray-300 rounded-md">
    </div>

    <div>
      <label for="mail" class="block font-semibold mb-1">Email :</label>
      <input type="email" id="mail" name="mail" required
             class="w-full px-4 py-2 border border-gray-300 rounded-md">
    </div>

    <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md">
      Ajouter le patient
    </button>
  </form>
</div>

<?php require_once 'footer.php'; ?>
