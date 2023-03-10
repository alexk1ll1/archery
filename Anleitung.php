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

<!-- Anleitung -->
<div class="container" id="containerAnleitung">
    <div class="col text-center">
        <h2>Spielanleitung</h2>
        <p>Schritt 1:</p>
        <p>Wenn noch kein User besteht, muss dieser zuerst angelegt werden.</p>
        <p>Schritt 2: </p>
        <p>Zunächst muss der Parkour, wenn noch nicht vorhanden, mit der Anzahl der Tiere erstellt werden.</p>
        <p>Schritt 3:</p>
        <p>Wenn 1. und 2. Schritt erfolgreich erledigt wurden kann es Los gehen.
            <br>Zuerst wird eine Party aller Mitspieler und dem Parkour erstellt.</p>
        <p>Los Geht´s:</p>
        <p>Nun kann nach der Reihe, wie am Bildschirm angezeigt geschossen werden und die erreichten Punkte
            <br>werden durch Klick auf die jeweiligen Buttons eingegeben.</p>
        <p>Auswertung:</p>
        <p>Zum Schluss kann man noch ein Scoreboard der Gruppe einsehen.</p>
        <br>
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
</body>
</html>