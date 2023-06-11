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

$id = $_SESSION['id'];
$query = "SELECT a.*, d.name AS doctor_name FROM appointments a
          INNER JOIN doctors d ON a.doctor_id = d.id
          WHERE a.patient_id = '$id'
          ORDER BY a.date ASC"; 
$result = mysqli_query($conn, $query);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="moje-wizyty.css">
    <title>Moje wizyty</title>
</head>
<body>
    <header>
        <h1>NOVAK-MED</h1>
        <a class="logout" href="logout.php">Wyloguj się</a>
        <a class="wizyty" href="dashboard.php">Strona główna</a>
    </header>
    <main>
        <div class="container">
            <h2>Moje wizyty</h2>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $doctorName = $row['doctor_name'];
                    $symptoms = $row['symptoms'];
                    $date = $row['date'];
                    
                    echo "<div class='visit'>";
                    echo "<p class='label'>Doktor: $doctorName</p>";
                    echo "<p class='label'>Dolegliwości: $symptoms</p>";
                    echo "<p class='label'>Data: $date</p>"."<br>";
                    echo "</div>";
                }
            } else {
                echo "<p>Brak wizyt.</p>";
            }
            ?>
            <a href="dashboard.php" class="powrot">Powrót do strony głównej</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 NOVAK-MED. Wszelkie prawa zastrzeżone.</p>
    </footer>
</body>
</html>
