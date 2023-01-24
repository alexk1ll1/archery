<?php
session_start();
if (!isset($_SESSION['userid'])) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
          integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="styles.css">
    <title>Archery</title>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
require "navbar.element.php";
?>

<div class="container">
    <canvas id="myChart"></canvas>
</div>
<div class="container">
    <canvas id="myChart2"></canvas>
</div>


<?php

$host = "localhost";
$dbname = "archery";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);


if (mysqli_connect_errno()) {
    die("Connection Error: " . mysqli_connect_error());
}


foreach ($_POST['user'] as $user_id) {

    $sql = "select nickname 
            from user
            where id = $user_id;";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    echo $user["nickname"];
    echo "<script> var user = '" . $user["nickname"] . "'; </script>";
}

echo "<script> points = []; </script>";

foreach ($_POST['user'] as $user_id) {

    $sql = "select user.nickname, user_party.id as party_id, arrow.id as arrow_id, avg(counting_method.points3) as points_per_shot
            from user
            inner join user_party
            on user.id = user_party.user_id
            inner join arrow
            on user_party.id = arrow.user_party_id
            inner join counting_method
            on arrow.counting_id = counting_method.id
            where user.id = $user_id
            group by party_id
            order by party_id, arrow_id";
    $result = mysqli_query($conn, $sql);

    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    foreach ($rows as $row) {
        echo "<script> points.push(" . $row["points_per_shot"] . "); </script>";
    }


}

echo "<script> rings = []; </script>";

foreach ($_POST['user'] as $user_id) {

    $sql = "select counting_method.ring as ring, count(counting_method.ring) as ringCount
            from user
            inner join user_party
            on user.id = user_party.user_id
            inner join arrow
            on user_party.id = arrow.user_party_id
            inner join counting_method
            on arrow.counting_id = counting_method.id
            where user.id = $user_id
            group by ring";
    $result = mysqli_query($conn, $sql);

    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    foreach ($rows as $row) {
        echo "<script> rings.push(" . $row["ringCount"] . "); </script>";
    }


}


?>

<script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>

<script>
    var xValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
    var yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];
    var averages = [points[0]];
    var games = [];

    for (var i = 0; i < points.length; i++) {
        games.push("Spiel " + (i + 1));
    }


    for (var i = 1; i < points.length; i++) {
        tmpArray = points.slice(0, i)
        var sum = 0;
        tmpArray.forEach(item => {
            sum += item;
        });
        var newAverage = sum / i;
        averages.push(newAverage);
    }

    new Chart("myChart", {
        type: "line",
        data: {
            labels: games,
            datasets: [{
                label: user,
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "#EA047E",
                data: averages
            }]
        },
        options: {
            legend: {display: false},
            scales: {
                yAxes: [{ticks: {min: 6, max: 16}}],
            }
        }
    });


    var ringsCanvas = document.getElementById("myChart2");

    Chart.defaults.font.family = "Lato";
    Chart.defaults.font.size = 15;
    Chart.defaults.color = "white";

    var ringsData = {
        labels: ["Volltreffer", "Mitte", "Außen", "Nicht getroffen"],
        datasets: [{
            data: rings,
            backgroundColor: [
                "rgba(255, 0, 0, 0.5)",
                "rgba(100, 255, 0, 0.5)",
                "rgba(200, 50, 255, 0.5)",
                "rgba(0, 100, 255, 0.5)"
            ]
        }]
    };

    var chartOptions = {
        plugins: {
            title: {
                display: true,
                align: "center",
                text: "Getroffene Ringe"
            },
            legend: {
                align: "start"
            }
        }
    };

    var polarAreaChart = new Chart(ringsCanvas, {
        type: 'polarArea',
        data: ringsData,
        options: chartOptions
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="script.js"></script>
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


