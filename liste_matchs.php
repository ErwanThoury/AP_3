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

// Récupérer les matchs de l'équipe sélectionnée dans la base de données
$equipe_id = $_POST["equipe_id"];
$sql = "SELECT id, date, equipe_dom_id, equipe_ext_id FROM MatchRugby WHERE equipe_dom_id = '$equipe_id' OR equipe_ext_id = '$equipe_id' ORDER BY date ASC";
$result = $conn->query($sql);

// Afficher les options de la liste déroulante des matchs
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $match_id = $row["id"];
        $date = date("d/m/Y", strtotime($row["date"]));
        $equipe_dom_id = $row["equipe_dom_id"];
        $equipe_ext_id = $row["equipe_ext_id"];
        // Récupérer les noms des équipes
        $equipe_dom = $conn->query("SELECT nom FROM Equipe WHERE id = '$equipe_dom_id'")->fetch_assoc()["nom"];
        $equipe_ext = $conn->query("SELECT nom FROM Equipe WHERE id = '$equipe_ext_id'")->fetch_assoc()["nom"];
        echo "<option value='" . $match_id . "'>" . $date . " : " . $equipe_dom . " vs " . $equipe_ext . "</option>";
    }
} else {
    echo "<option value=''>Aucun match trouvé pour cette équipe</option>";
}

// Fermer la connexion à la base de données
$conn->close();
?>
