<?php
// Connexion à la base de données
$servername = "";
$username = "";
$password = "";
$dbname = "";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer les joueurs de l'équipe sélectionnée dans la base de données
$equipe_id = $_POST["equipe_id"];
$sql = "SELECT id, nom, prenom FROM Joueur WHERE equipe_id = '$equipe_id' ORDER BY nom ASC, prenom ASC";
$result = $conn->query($sql);

// Afficher les options de la liste déroulante des joueurs
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "'>" . $row["nom"] . " " . $row["prenom"] . "</option>";
    }
} else {
    echo "<option value=''>Aucun joueur trouvé pour cette équipe</option>";
}

// Fermer la connexion à la base de données
$conn->close();
?>
