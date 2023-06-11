<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "przychodnia";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
}

$doctorName = $_SESSION['doctorName'];
$symptoms = $_SESSION['symptoms'];
$date = $_SESSION['date'];

$query = "SELECT name FROM doctors WHERE name = '$doctorName'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $doctorName = $row['name'];
} else {
    $doctorName = "Nieznany lekarz";
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="potwierdzenie.css">
    <title>Umówienie wizyty</title>
    <header>
        <h1>NOVAK-MED</h1>
</header>

</head>
<body>
    <div class="container">
        <?php
        echo "<h2>Umówienie wizyty</h2>";
        echo "<p class='label'>Doktor:</p>";
        echo "<p>$doctorName</p>";
        echo "<p class='label'>Dolegliwości:</p>";
        echo "<p>$symptoms</p>";
        echo "<p class='label'>Data:</p>";
        echo "<p>$date</p>";
        ?>
        <br>
        <a class="powrot" href="dashboard.php">Powrót na stronę główną</a> 
    </div>
    <footer>
        <p>&copy; 2023 NOVAK-MED. Wszelkie prawa zastrzeżone.
    </footer>
</body>
</html>
