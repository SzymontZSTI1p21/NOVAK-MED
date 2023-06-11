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
$query = "SELECT * FROM doctors";
$result = mysqli_query($conn, $query);

$dateQuery = "SELECT DISTINCT date FROM appointments";
$dateResult = mysqli_query($conn, $dateQuery);
$availableDates = array();

if ($dateResult && mysqli_num_rows($dateResult) > 0) {
    while ($row = mysqli_fetch_assoc($dateResult)) {
        $availableDates[] = $row['date'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctorName = $_POST['doctor'];
    $symptoms = $_POST['symptoms'];
    $date = $_POST['date'];

    if (in_array($date, $availableDates)) {
        $errorMessage = "<div class='nope'>Wybrana data jest niedostępna. Proszę wybrać inną datę.</div>";
    } else {

        $insertQuery = "INSERT INTO appointments (doctor_id, patient_id, symptoms, date)
                        SELECT id, $id, '$symptoms', '$date'
                        FROM doctors
                        WHERE name = '$doctorName'";

        mysqli_query($conn, $insertQuery);

        $_SESSION['doctorName'] = $_POST['doctor'];
        $_SESSION['symptoms'] = $_POST['symptoms'];
        $_SESSION['date'] = $_POST['date'];

        session_regenerate_id(true);

        header("Location: potwierdzenie.php");
        exit();
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="zalogowanyStyle.css">
<head>
<title>Dashboard</title>
</head>
<body>
<header>
<h1>NOVAK-MED</h1>
<h2 class="naglowekCos">Witaj, pomyślnie zalogowano!</h2>
<a class="logout" href="logout.php">Wyloguj się</a>
<a class="wizyty" href="moje-wizyty.php">Moje wizyty</a>
</header>
<main>
<div class="container">
<div class="left-panel">
<form method="POST">
<h2>Wybierz lekarza:</h2>
<label for="lekarz"></label>
<select name="doctor" id="lekarz">
<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $doctorName = $row['name'];
        $specialization = $row['specialization'];
        echo "<option value='$doctorName'>$doctorName - $specialization</option>";
    }
} else {
    echo "Brak dostępnych lekarzy.";
}
?>
</select>
<h2>Opisz swoje dolegliwości:</h2>
<textarea name="symptoms" id="symptoms" rows="4" cols="50"></textarea>
<br>
<div class="right-panel">
<h2>Wybierz datę:</h2>
<input type="date" name="date" id="date" min="<?php echo date('Y-m-d'); ?>" required>
</div>
<button type="submit">Umów wizytę</button>
</form>
<?php if (isset($errorMessage)) { ?>
    <p><?php echo $errorMessage; ?></p>
<?php } ?>
</div>
</div>
</main>
<footer>
<p>&copy; 2023 NOVAK-MED. Wszelkie prawa zastrzeżone.</p>
</footer>
</body>
</html>

