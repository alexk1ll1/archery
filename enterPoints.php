<?php


print_r($_POST);

$user_party_id = $_POST["user_party_id"];
$current_arrow = $_POST["current_arrow"];
$animal_number = $_POST["animal_number"];
$ring = $_POST["ring"];

$host = "localhost";
$dbname = "archery";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password ,$dbname);

if (mysqli_connect_errno()){
    die("Connection Error: " . mysqli_connect_error());
}

echo "Connection successful.";
/*
$sql = "INSERT INTO arrow (user_party_id, counting_id, animal_number)
        VALUES (?, ?, ?)";
*/

$sql = "INSERT INTO arrow (user_party_id, counting_id, animal_number)
        VALUES (?, (select id from counting_method
        where ring = ? and arrow = ?), ?)";


$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)){
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "iiii",
    $user_party_id,
    $ring,
    $current_arrow,
    $animal_number
);

mysqli_stmt_execute($stmt);

echo "Record saved";
