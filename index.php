<!DOCTYPE html>
<html lang=pl>
<head>
<meta charset=UTF-8>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=viewport content="width=device-width, initial-scale=1.0">
<title>NOVAK-MED</title>
<link rel=stylesheet href=novakmed.css>
</head>
<body>
<header>
<h1>NOVAK-MED</h1>
</header>
<main>
<section>
<div class=srodek>
<img class=logo src=logo.png alt=logo>
<form action=login.php method=post class=form1>
<div class=login>
<label class=email>Email:</label>
<input type=email name=email placeholder=Email class=mail required>
<label class=has>Hasło:</label>
<input type=password name=password placeholder=Hasło class=haslo required>
<button type=submit>Zaloguj się</button>
</div>
</form>
</div>
</section>
<section>
<form action=register.php method=POST class=form2>
<label>Email:</label>
<input type=email placeholder=Email class=em1 name=email required>
<label>Hasło:</label>
<input type=password placeholder=Hasło class=em2 name=password required>
<br>
<input type=submit value=Zarejestruj class=zar>
</form>
</section>
</main>
<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projekt";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Nie udało się połączyć z bazą danych: " . mysqli_connect_error());
    }

    ?>
<footer>
<p>&copy; 2023 NOVAK-MED. Wszelkie prawa zastrzeżone.</p>
</footer>
</body>
</html>
