<?php


print_r($_POST);

$parkourName = $_POST["parkourName"];
$location = $_POST["location"];
$numOfTargets = filter_input(INPUT_POST, "numOfTargets", FILTER_VALIDATE_INT);

$host = "localhost";
$dbname = "archery";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password ,$dbname);

if (mysqli_connect_errno()){
    die("Connection Error: " . mysqli_connect_error());
}

echo "Connection successful.";

$sql = "INSERT INTO parcour (name, location, animal_count)
        VALUES (?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)){
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssi",
                 $parkourName,
                        $location,
                        $numOfTargets
);

mysqli_stmt_execute($stmt);

echo "Record saved";