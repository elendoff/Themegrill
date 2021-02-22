<?php
include 'databaseconnection.php';

$sql = "SELECT * FROM `todo_list` ORDER BY id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

?>
        <li>
            <span class="text"><?php echo $row['detail']; ?></span>
            <i id="removeBtn" class="icon fa fa-trash" data-id="<?php echo $row['id']; ?>"></i>
        </li>
<?php
    }
} else {
    echo 'No Record found';
}
?>