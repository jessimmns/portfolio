<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio"; // Remplace par le nom de ta base de données

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variables initialisées pour éviter les erreurs de variables non définies
$title = $author = $date = $summary = $source = '';
$id = null;

// Vérification si un article doit être modifié
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM articles WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $author = $row['author'];
        $date = $row['date'];
        $summary = $row['summary'];
        $source = $row['source'];
    }
}

// Fermeture de la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter ou Modifier un Article</title>
  <link rel="stylesheet" href="tableau.css">
</head>
<body>

<h1><?php echo $id ? "Modifier l'Article" : "Ajouter un Nouvel Article"; ?></h1>

<!-- Formulaire pour ajouter ou modifier un article -->
<form action="submit_article.php" method="POST">
  <input type="hidden" name="id" value="<?php echo $id; ?>">

  <label for="title">Titre de l'Article :</label><br>
  <input type="text" id="title" name="title" value="<?php echo $title; ?>" required><br><br>
  
  <label for="author">Auteur :</label><br>
  <input type="text" id="author" name="author" value="<?php echo $author; ?>" required><br><br>
  
  <label for="date">Date :</label><br>
  <input type="date" id="date" name="date" value="<?php echo $date; ?>" required><br><br>

  <label for="summary">Résumé de l'Article :</label><br>
  <textarea id="summary" name="summary" rows="4" cols="50" required><?php echo $summary; ?></textarea><br><br>

  <label for="source">Source de l'Article (optionnel) :</label><br>
  <input type="text" id="source" name="source" value="<?php echo $source; ?>"><br><br>

  <input type="submit" value="<?php echo $id ? "Mettre à Jour l'Article" : "Ajouter l'Article"; ?>">
</form>

</body>
</html>
<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio"; // Remplace par le nom de ta base de données

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si les données sont envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $date = $_POST['date'];
    $summary = $_POST['summary'];
    $source = $_POST['source'];
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    // Si c'est une modification d'article
    if ($id) {
        // Mettre à jour un article existant
        $sql = "UPDATE articles SET title='$title', author='$author', date='$date', summary='$summary', source='$source' WHERE id='$id'";
    } else {
        // Ajouter un nouvel article
        $sql = "INSERT INTO articles (title, author, date, summary, source) VALUES ('$title', '$author', '$date', '$summary', '$source')";
    }

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
        echo "L'article a été " . ($id ? "modifié" : "ajouté") . " avec succès!";
        echo "<br><a href='index.php'>Retourner à la liste des articles</a>";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio"; // Remplace par le nom de ta base de données

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les articles depuis la base de données
$sql = "SELECT id, title, author, date, summary, source FROM articles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher chaque article
    while($row = $result->fetch_assoc()) {
        echo "<div class='article'>";
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p><strong>Auteur :</strong> " . $row["author"] . "</p>";
        echo "<p><strong>Date :</strong> " . $row["date"] . "</p>";
        echo "<p><strong>Résumé :</strong> " . nl2br(htmlspecialchars($row["summary"])) . "</p>";
        echo "<p><strong>Source :</strong> " . $row["source"] . "</p>";
        echo "<a href='add_edit_article.php?id=" . $row["id"] . "'>Modifier l'Article</a>";
        echo "</div>";
    }
} else {
    echo "Aucun article trouvé.";
}

$conn->close();
?>

  

