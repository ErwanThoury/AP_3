<?php
// Connexion à la base de données
$servername = "";
$username = "";
$password = "";
$dbname = "";$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer les équipes dans la base de données
$sql = "SELECT id, nom FROM Equipe ORDER BY nom ASC";
$result = $conn->query($sql);

// Afficher les options de la liste déroulante des équipes
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "'>" . $row["nom"] . "</option>";
    }
} else {
    echo "<option value=''>Aucune équipe trouvée</option>";
}

// Fermer la connexion à la base de données
$conn->close();
?>
