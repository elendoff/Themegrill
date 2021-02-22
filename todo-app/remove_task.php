<?php

include 'databaseconnection.php';

$id = $_POST['id'];

$sql = "DELETE FROM todo_list WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo 1;
} else {
    echo 0;
}
