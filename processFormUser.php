<?php


print_r($_POST);

$fName = $_POST["fName"];
$lName = $_POST["lName"];
$nName = $_POST["nName"];

$host = "localhost";
$dbname = "archery";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password ,$dbname);

if (mysqli_connect_errno()){
    die("Connection Error: " . mysqli_connect_error());
}

echo "Connection successful.";

$sql = "INSERT INTO user (v_name, name, nickname)
        VALUES (?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)){
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sss",
    $fName,
    $lName,
    $nName
);

mysqli_stmt_execute($stmt);

echo "Record saved";