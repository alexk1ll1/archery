<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
          integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="styles.css">
    <title>Archery Test</title>

</head>
<body>
<!-- Nav Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
    <div class="container-fluid">
        <a class="navbar-brand" id="brand" href="index.html">
            <img src="./images/dinoColor.png" id="dino" alt="Dino" width="100" height="80"
                 class="d-inline-block align-text-top ">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="userLogin.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="statistics.php">Statistiken</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Anleitung.html">Anleitung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userRegistration.php">Registrieren</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=archery', 'root', '');

if (isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM login_users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<?php
if (isset($errorMessage)) {
    echo $errorMessage;
}
?>
<div class="container">
    <div class="row"></div>
    <div class="col text-center">
        <form action="?login=1" method="post">
            <div class="container">
                <div class="col text-center">
                    <div class="row justify-content-center">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail</label>
                            <input type="email" size="40" class="form-control" maxlength="250" name="email">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="col text-center">
                        <div class="row justify-content-center">
                            <div class="mb-3">
                                <label for="passwort" class="form-label">Passwort</label>
                                <input type="password" class="form-control" size="40" maxlength="250" name="passwort">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" style="background-color: #099701; border-color: white"
                        id="buttonCreateUser">Login
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
        integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="script.js"></script>

</body>
</html>
