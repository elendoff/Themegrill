<?php
include 'databaseconnection.php';

$detail = $_POST['detail'];

$sql = "INSERT INTO todo_list (detail) VALUES ('$detail')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo 1;
} else {
    echo 0;
}
