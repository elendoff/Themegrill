<?php
class operation
{
    private $DB;
    private $detail = '';
    private $action = '';
    public function __construct($post)
    {
        include 'DB.php';
        $this->DB = new DB();
        if (isset($post['detail'])) {
            $this->detail = ($post['detail']);
        } elseif (isset($post['action']) == 'load') {
            $this->show_task();
        } else {
            $this->delete = $post['id'];
            $this->delete_task();
        }
        if (!empty($this->detail)) {
            $this->add_task();
        }
    }
    public function add_task()
    {
        $detail = $this->detail;
        $sql = "INSERT INTO todo_list (detail) VALUES ('$detail')";
        $this->DB->insert($sql);
        echo "inserted";
    }

    public function show_task()
    {
        $output = '';
        $sql = "SELECT * FROM `todo_list` ORDER BY id DESC";
        $data = $this->DB->get_data($sql);
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

    public function delete_task()
    {
        $id = $this->delete;
        $sql = "DELETE FROM todo_list WHERE id='$id'";
        $this->DB->delete($sql);
        echo "deleted";
    }
}

$obj = new operation($_REQUEST);
