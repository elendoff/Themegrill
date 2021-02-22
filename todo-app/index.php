<?php
include   'databaseconnection.php';

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">

        <div class="row">
            <div class="card">
                <div class="card-header">
                    TODO APP</div>
                <div class="card-body">
                    <div class="col-md-12">
                        <span id="message"></span>
                        <div class="input-group">
                            <input type="text" name="detail" id="detailtext" class="form-control input-lg" autocomplete="off" placeholder="Enter Your" />
                            <div class="input-group-btn">
                                <button type="submit" name="submit" id="submit" class="btn "><i class="fa fa-plus"></i></button>
                            </div>
                        </div><br>
                        <br>
                        <div class="content">
                            <ul id="tasks">

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            function loadtask() {
                $.ajax({
                    url: 'show_task.php',
                    type: 'POST',
                    success: function(data) {
                        $('#tasks').html(data);
                    }
                })
            }
            loadtask();

            $('#submit').on('click', function(event) {
                event.preventDefault();
                if ($('#detailtext').val() == '') {
                    $('#message').html('<div class="alert alert-danger">Enter Task Details</div>');
                    return false;
                } else {
                    var detail = $('#detailtext').val();
                    $.ajax({
                        url: 'add_task.php',
                        type: 'POST',
                        data: {
                            detail: detail
                        },
                        success: function(data) {
                            if (data == 1) {
                                loadtask();
                                $()

                            }
                        }
                    })
                }
            });
            $(document).on('click', "#removeBtn", function(event) {
                var id = $(this).data('id');
                $.ajax({
                    url: "remove_task.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        loadTasks();
                        if (data == 0) {
                            alert("Something wrong went. Please try again.");
                        }
                    }
                });

            });







        });
    </script>

</body>


</html>