<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $db_password = ""; 
    $dbname = "przychodnia";

    $conn = mysqli_connect($servername, $username, $db_password, $dbname);

    if (!$conn) {
        die("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM Users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        if (password_verify($password, $stored_password)) {
            $_SESSION['email'] = $email;

            $id = $row['id'];
            $_SESSION['id'] = $id;

            header("Location: dashboard.php"); 
            exit();
        }
    }

    echo "Błędne dane logowania.";
}
?>