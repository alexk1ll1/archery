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
        <a class="navbar-brand" id="brand" href="#">
            <img src="dinoColor.png" id="dino" alt="Dino" width="100" height="80"
                 class="d-inline-block align-text-top ">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="stats.html">Leaderboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Anleitung</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Dropdown link
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

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

echo "Connection successful.";

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

$sql="select user.nickname, user.id
        from user
        inner join user_party
        on user.id = user_party.user_id
        where user_party.party_id = $party_id;";
$players = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($players)) {
    echo $row["nickname"];
}

?>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>
