<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "przychodnia";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="message">Użytkownik o podanym adresie email już istnieje.'.'<br>';
        echo '<a href="index.php">wróć na stronę główną</a></div>';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        $insert_query = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
    
        if (mysqli_query($conn, $insert_query)) {
            echo '<div class="message">Rejestracja zakończona sukcesem. Możesz się zalogować.'.'<br>';
            echo '<a href="index.php">wróć na stronę główną</a></div>';
        } else {
            echo '<div class="message">Błąd podczas rejestracji: ' . mysqli_error($conn) . '</div>';
        }
    }
}    

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang=pl>
<head>
<meta charset=UTF-8>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<link rel=stylesheet href=register.css>
<meta name=viewport content="width=device-width, initial-scale=1.0">
<title>NOVAK-MED</title>
</head>
<body>
<header>
<h1>NOVAK-MED</h1>
</header>
<footer>
<p>&copy; 2023 NOVAK-MED. Wszelkie prawa zastrzeżone.
</footer>
</body>
</html>