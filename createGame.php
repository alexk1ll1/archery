<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"
          referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Title</title>
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
                    <a class="nav-link active" aria-current="page" href="index.html">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="stats.html">Leaderboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Anleitung.html">Anleitung</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="message">

</div>

<button id="volltreffer" value="1" onclick="nextVolltreffer(this)"><img src="./images/Zielscheibe_1.png" id="Z1" alt="Z1" width="100" height="100"></button>
<button id="mitte" value="2" onclick="nextVolltreffer(this)"><img src="./images/Zielscheibe_2.png" id="Z2" alt="Z2" width="100" height="100"></button>
<button id="aussen" value="3" onclick="nextVolltreffer(this)"><img src="./images/Zielscheibe_3.png" id="Z3" alt="Z3" width="100" height="100"></button>
<button id="nicht_getroffen" value="4" onclick="nextNichtVolltreffer(this)"><img src="./images/Zielscheibe_grau.png" id="Zg" alt="Zg" width="100" height="100"></button>

<div class="container mt-5">

<?php

print_r($_POST);
foreach ($_POST['user'] as $user_id) {
    print_r($user_id);
}

$host = "localhost";
$dbname = "archery";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password ,$dbname);


if (mysqli_connect_errno()){
    die("Connection Error: " . mysqli_connect_error());
}


$sql = "INSERT INTO party (parcour_id)
        VALUES (?)";
$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)){
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

    if ( ! mysqli_stmt_prepare($stmt, $sql)){
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ii",
        $user_id,
    $party_id
    );

    mysqli_stmt_execute($stmt);

}


mysqli_select_db($conn,"archery");

$sql="select user.nickname, user.id, user_party.id as upid
        from user
        inner join user_party
        on user.id = user_party.user_id
        where user_party.party_id = $party_id;";

echo "<script> var user_dict = {}; </script>";

$players = mysqli_query($conn,$sql);
$fetchTest = mysqli_fetch_array($players);
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
while($row = mysqli_fetch_array($players)) {
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

        function nextVolltreffer (x) {
            if (current_player == max_player_count){
                current_player = 1;
                current_animal ++;
            }else{
                current_player ++;
            }
            current_arrow = 1;
            console.log(current_player);

            var countingMultiplier = x.value;

            uploadPoints(parseInt(Object.values(user_dict)[current_player - 1]), parseInt(current_animal), current_arrow, countingMultiplier);

            printCurrentState();
        }

        function nextNichtVolltreffer (x) {
            if (current_arrow == max_arrow){
                current_arrow = 1;
                if (current_player == max_player_count){
                    current_player = 1;
                    current_animal ++;
                }else{
                    current_player ++;
                }
            }else current_arrow ++;

            var countingMultiplier = x.value;

            console.log(countingMultiplier);
            console.log(counting_id);
            console.log(counting_id + 4*countingMultiplier);

            uploadPoints(parseInt(Object.values(user_dict)[current_player - 1]), parseInt(current_animal), current_arrow, countingMultiplier);

            printCurrentState();
        }

        function printCurrentState () {
            newP = document.createElement("p");
            document.getElementById("message").innerHTML = "<p>" + Object.keys(user_dict)[current_player -1] + ", du bist dran " + "<br>" +
                current_animal + " Tier" + " / " + current_arrow + " Pfeil." +
                "</p>" + "<br>" + current_player;
        }

        console.log(Object.values(user_dict)[0]);


    </script>

</div>
<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>
