<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"
          referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
    <title>Archery Test</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav" style="display: block">
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
                    <a class="nav-link" href="statistics.php">Leaderboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Anleitung.html">Anleitung</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <?php

    $con = mysqli_connect('localhost','root','');
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }

    mysqli_select_db($con,"archery");
    $sql="SELECT * FROM user";
    $result = mysqli_query($con,$sql);
    $sql2="SELECT * FROM parcour";
    $result2 = mysqli_query($con, $sql2);

    echo '  <div class="h-100 d-flex align-items-center justify-content-center">
            <form action="createStatistics.php" id="createGameForm" method="post">
            <select  class="selectpicker" id="user" name="user[]" multiple aria-label="Default select example" data-live-search="true";>
            </div>';
    while($row = mysqli_fetch_array($result)) {
        echo "<option value='" . $row["id"] . "'>" . $row["nickname"] . "</option>";
    }
    echo "</select>";

    echo "<input type='submit' id='submit'>";
    echo "</form>";

    ?>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>