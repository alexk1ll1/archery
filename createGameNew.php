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

<div class="container" id="message" style="text-align: center; margin-top: 5vh; font-size: 15pt;">

</div>
<div class="h-20 d-flex align-items-center justify-content-center" id="Zielscheibe">
    <button id="volltreffer" value="1" data-points="20" onclick="nextVolltreffer(this)"><img
                src="./images/Zielscheibe_1.png" id="Z1" width="100" height="100"></button>
    <button id="mitte" value="2" data-points="18" onclick="nextVolltreffer(this)"><img src="./images/Zielscheibe_2.png"
                                                                                       id="Z2" width="100" height="100">
    </button>
    <button id="aussen" value="3" data-points="16" onclick="nextVolltreffer(this)"><img src="./images/Zielscheibe_3.png"
                                                                                        id="Z3" width="100"
                                                                                        height="100"></button>
    <button id="nicht_getroffen" value="4" data-points="0" onclick="nextNichtVolltreffer(this)"><img
                src="./images/Zielscheibe_grau.png" id="Zg" width="100" height="100"></button>
</div>

<div class="container" id="chartBox" style="width: 100%; height: 100%">
    <canvas id="myChart"></canvas>
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


$sql = "INSERT INTO party (parcour_id)
        VALUES (?)";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i",
    $_POST["parcour"]
);

mysqli_stmt_execute($stmt);

$parcour_id = $_POST["parcour"];
$party_id = mysqli_insert_id($conn);


$sql = "select animal_count from parcour where id = $parcour_id";
$result = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_assoc($result);

echo
    "<script>
    var animal_count = " . $row1["animal_count"] . ";" .
    "</script>";

// Insert User Data needed for Game
foreach ($_POST['user'] as $user_id) {

    $sql = "INSERT INTO user_party (user_id, party_id)
        VALUES (?, ?)";


    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ii",
        $user_id,
        $party_id
    );

    mysqli_stmt_execute($stmt);

}


mysqli_select_db($conn, "archery");

$sql = "select user.nickname, user.id, user_party.id as upid
        from user
        inner join user_party
        on user.id = user_party.user_id
        where user_party.party_id = $party_id;";

echo "<script> var user_dict = {}; </script>";

$players = mysqli_query($conn, $sql);
//$fetchTest = mysqli_fetch_array($players);
/*
while($row = mysqli_fetch_array($players)) {
    echo ("UserName: ");
    echo $row["nickname"];
    echo "<br>";
    echo "UPid: ";
    echo $row["upid"];
    echo "<br>";
}
*/
while ($row = mysqli_fetch_array($players)) {
    echo "<script> user_dict[";
    echo "'";
    echo $row['nickname'];
    echo "'";
    echo "] = ";
    echo $row['upid'];
    echo "</script>";
}

?>

<script>
    console.log(user_dict);
    console.log(animal_count);
    var max_animals = animal_count;
    var max_player_count = Object.keys(user_dict).length;
    var max_arrow = 3;
    var current_arrow = 1;
    var current_animal = 1;
    var current_player = 1;
    var counting_id = 1;

    printCurrentState();

    function nextVolltreffer(x) {
        var countingMultiplier = x.value;
        uploadPoints(parseInt(Object.values(user_dict)[current_player - 1]), parseInt(current_animal), current_arrow, countingMultiplier);
        var points = parseInt(x.getAttribute("data-points")) - (6 * (current_arrow - 1));
        addData(points, current_player - 1);
        if (current_player == max_player_count) {
            current_player = 1;
            console.log(current_animal);
            current_animal++;
        } else {
            current_player++;
        }
        current_arrow = 1;
        console.log(current_player);
        printCurrentState();
    }

    function nextNichtVolltreffer(x) {
        var countingMultiplier = x.value;
        uploadPoints(parseInt(Object.values(user_dict)[current_player - 1]), parseInt(current_animal), current_arrow, countingMultiplier);
        if (current_arrow == max_arrow) {
            var points = parseInt(x.getAttribute("data-points"));
            addData(points, current_player - 1);
            current_arrow = 1;
            if (current_player == max_player_count) {
                current_player = 1;
                console.log(current_animal);
                current_animal++;
            } else {
                current_player++;
            }
        } else current_arrow++;


        console.log(countingMultiplier);
        console.log(counting_id);
        console.log(counting_id + 4 * countingMultiplier);


        printCurrentState();
    }

    function printCurrentState() {
        if (current_animal > max_animals) {
            document.getElementById("message").innerHTML = "<p>Ende<p>";
            $("#Zielscheibe").fadeOut(1500);
            $("#Zielscheibe").delay(1500);
            createTable();

            document.getElementById("Zielscheibe").remove();
        } else {
            newP = document.createElement("p");
            document.getElementById("message").innerHTML = "<p>" + "<strong style='font-weight: 700;'>" + Object.keys(user_dict)[current_player - 1] + "</strong>" + ", du bist dran " + "<br>" +
                current_animal + " Tier" + " / " + current_arrow + " Pfeil." +
                "</p>" + "<br>";
        }

    }

    console.log(Object.values(user_dict)[0]);


    var labels = [];
    var colors = ["#EA047E", "#FF6D28", "#FCE700", "#00F5FF", "red", "green", "blue", "white"];
    var players = Object.keys(user_dict);
    var gameChart = document.getElementById("myChart");

    for (var i = 0; i <= max_animals; i++) {
        labels.push("Tier " + i);
    }
    var dataAll = {
        labels: labels,
        datasets: []
    }
    var chartOptions = {
        legend: {
            display: true,
            position: 'top',
            labels: {
                boxWidth: 80,
                fontColor: 'white'
            }
        }
    };
    var lineChart = new Chart(gameChart, {
        type: 'line',
        data: dataAll,
        options: chartOptions
    });
    for (var i = 0; i < players.length; i++) {

        var newDataset = {
            label: players[i],
            data: [0],
            lineTension: 0,
            fill: false,
            borderColor: colors[i]
        };
        lineChart.data.datasets.push(newDataset);
        lineChart.update();
    }


    function addData(points, currentPlayer, currentArrow) {
        var currentPoints = lineChart.data.datasets[currentPlayer].data[lineChart.data.datasets[currentPlayer].data.length - 1]
        lineChart.data.datasets[currentPlayer].data.push(currentPoints + points);
        lineChart.update();
    }


    function createTable() {
        console.log('triggered');
        const chartBox = document.querySelector('#chartBox');
        const tableDiv = document.createElement('div');
        tableDiv.setAttribute('id', 'tableDiv');

        const table = document.createElement('table');
        table.classList.add('table', 'table-fit', 'mt-5', 'table-dark', 'table-striped');

        //add thead
        const thead = table.createTHead();
        thead.classList.add('chartjs-thead');

        thead.insertRow(0);
        for (let i = 0; i < lineChart.data.labels.length; i++) {
            thead.rows[0].insertCell(i).innerText = lineChart.data.labels[i];
        }
        thead.rows[0].insertCell(0).innerText = 'Tiere';
        thead.rows[0].insertCell(lineChart.data.labels.length + 1).innerText = 'Durchschnitt';

        //tbody
        const tbody = table.createTBody();
        tbody.classList.add('chartjs-tbody');

        lineChart.data.datasets.map((dataset, index) => {
            tbody.insertRow(index);
            for (let i = 0; i < lineChart.data.datasets[0].data.length; i++) {
                tbody.rows[index].insertCell(i).innerText = dataset.data[i];
            }
            tbody.rows[index].insertCell(0).innerText = dataset.label;
            tbody.rows[index].insertCell(lineChart.data.datasets[0].data.length + 1).innerText = (dataset.data[dataset.data.length - 1]) / (dataset.data.length - 1);
        })


        //append
        chartBox.appendChild(tableDiv);
        tableDiv.appendChild(table);
    }

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

