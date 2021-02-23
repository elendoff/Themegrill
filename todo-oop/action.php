<?php
include 'DB.php';
$obj = new DB();


// show data

if (isset($_POST['action'])) {

    if ($_POST['action'] == 'delete') {
        $id = $_POST['id'];
        $sql = "DELETE FROM todo_list WHERE id='$id'";
        $obj->delete($sql);
        echo "deleted";
    }
    if ($_POST['action'] == 'load') {
        $output = '';
        $sql = "SELECT * FROM `todo_list` ORDER BY id DESC";
        $data = $obj->get_data($sql);
        $output .= '<tr>
        <th>Task</th>
         <th>Action</th>
        </tr>';
        while ($row = $data->fetch_assoc()) {
            $output .= '<tr>
            <td>' . $row['detail'] . '</td>
            <td><button type="button" class="btn btn-danger" id="remove-btn" data-id="' . $row['id'] . '">Delete</button></td>
            </tr>';
        }
        echo $output;
    }
}
// add items
if (isset($_POST['detail'])) {
    if (!empty($_POST['detail'])) {
        $detail = $_POST['detail'];
        $sql = "INSERT INTO todo_list (detail) VALUES ('$detail')";
        $obj->insert($sql);
        echo "inserted";
    }
}
