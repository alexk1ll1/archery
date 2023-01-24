<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: loginError.html");
}
?>
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

<?php
require "navbar.element.php";
?>

<div class="container" id="createUserContainer">
    <div class="col text-center">
        <h2>Spiel</h2>

        <?php

        $con = mysqli_connect('localhost', 'root', '');
        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }

        mysqli_select_db($con, "archery");
        $sql = "SELECT * FROM user";
        $result = mysqli_query($con, $sql);
        $sql2 = "SELECT * FROM parcour";
        $result2 = mysqli_query($con, $sql2);

        echo '  
            <form action="createGameNew.php" id="createGameForm" method="post">
            <div class="d-flex align-items-center justify-content-center">
            <div class="row gy-3 justify-content-center">
            <div class="col text-center" style="margin-right: 20px">
            <div class="mb-3">
            <label style="margin-left: 20px" for="user[]" class="form-label">Mitspieler</label>
            <select class="selectpicker" id="user" name="user[]" multiple aria-label="Default select example" data-live-search="true";>
            ';
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row["id"] . "'>" . $row["nickname"] . "</option>";
        }
        echo "</select>";

        echo '</div>
            </div>
            </div>
            </div>';

        echo '<div class="d-flex align-items-center justify-content-center">';
        echo '<div class="row gy-3 justify-content-center">';
        echo '<label for="parcour" class="form-label">Parkour</label>';
        echo '<select style="margin-top: 0px" name="parcour" id="parcour" class="form-select" aria-label="Default select example">';
        while ($row = mysqli_fetch_array($result2)) {
            echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
        }
        echo "</select>";
        echo '</div>';
        echo '</div>';
        echo "<div class='container'>";
        echo "<div class='row gy-4'>";
        echo "<div style='margin-top: 0px;' class='col-12 text-center'>";
        echo "<button class='btn btn-primary' type='submit'>3-Pfeilwertugn
              </button>";
        echo "</div>";


        echo "<div  class='col-12 text-center'>";
        echo "<button class='btn btn-primary' type='submit' formaction='createGame2New.php'>2-Pfeilwertung
              </button>";
        echo "</div>";
        echo "<div class='col-12 text-center'>";
        echo '<a class="btn btn-primary" href="index.php"
                                role="button">Zurück</a>';

        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</form>";


        ?>

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

</body>
</html>
