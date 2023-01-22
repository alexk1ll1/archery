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
<?php

require "navbar.element.php";
?>

<?php
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
        die('<div class="container" id="containerAnleitung">
  <div class="col text-center">
    <h2>Erfolgreich eingeloggt</h2>
  </div>
</div>');
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
    <div class="col text-center" id="createUserContainer">
        <form action="?login=1" method="post">
            <div class="container">
                <div class="col text-center">
                    <h2>Login</h2>
                    <div class="row justify-content-center">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail</label>
                            <input type="email" size="40" placeholder="E-Mail" class="form-control" maxlength="250"
                                   name="email">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="col text-center">
                        <div class="row justify-content-center">
                            <div class="mb-3">
                                <label for="passwort" class="form-label">Passwort</label>
                                <input type="password" class="form-control" placeholder="Passwort" size="40"
                                       maxlength="250" name="passwort">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit"
                            id="buttonCreateUser">Login
                    </button>
                    <a class="btn btn-primary" href="index.php"
                       role="button">Zurück</a>
                </div>
            </div>
        </form>
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
